=begin
  Actually, there are 2 process: 
  1. receiving the goods
  2. 
=end

class RollerWarehouseMutation < ActiveRecord::Base
  has_many :roller_warehouse_mutation_details 
  belongs_to :roller_identification  
  
  validates_presence_of :warehouse_mutation_date, :roller_identification_id 
  
  validate :valid_roller_identification_id , :roller_identification_must_be_confirmed
  
  def valid_roller_identification_id
    return if not  roller_identification_id.present? 
    
    object = RollerIdentification.find_by_id roller_identification_id 
    
    if object.nil?
      self.errors.add(:roller_identification_id, "Harus valid")
      return self 
    end
  end
  
  def roller_identification_must_be_confirmed
    return if not roller_identification_id.present? 
    
    if not roller_identification.is_confirmed? 
      self.errors.add(:roller_identification_id, "Roller Identification harus sudah di konfirmasi")
      return self 
    end
  end
  
   
  
  
  def self.create_object( params ) 
    new_object = self.new
    new_object.warehouse_mutation_date          = params[:warehouse_mutation_date]
    new_object.description              = params[:description]
    new_object.roller_identification_id = params[:roller_identification_id] 


    
    if new_object.save 
      now = DateTime.now
      year = now.year
      month = now.month 
      
      
      beginning_of_the_month_datetime = now.beginning_of_month
      end_of_the_month_datetime = (now + 1.months).beginning_of_month - 1.second
      
      total_item_created_in_current_month = self.where(
        :warehouse_mutation_date => beginning_of_the_month_datetime..end_of_the_month_datetime
      ).count 
      
      new_object.code = "#{year}/#{month}/#{total_item_created_in_current_month}"
      
      new_object.warehouse_id = roller_identification.warehouse_id 
      new_object.save
       
      
    end
    
    return new_object 
  end
  
  def update_object(params )
    if self.is_confirmed?
      self.errors.add(:generic_errors, "Sudah Konfirmasi")
      return self 
    end
    
    if self.roller_warehouse_mutation_details.count != 0 
      self.errors.add(:generic_errors, "sudah ada identifikasi")
      return self 
    end
    
    self.warehouse_mutation_date          = params[:warehouse_mutation_date]
    self.description              = params[:description]
    self.roller_identification_id = params[:roller_identification_id]

    
    self.save 
    
    return self
  end
  
  def all_roller_warehouse_mutation_details_deletable?
    self.roller_warehouse_mutation_details.each do |x|
      return x.deletable? if not x.deletable?
    end
    
    return true
  end
  
  
  def delete_object
    if self.is_confirmed?
      self.errors.add(:generic_errors, "sudah di konfirmasi")
      return self
    else
      self.roller_warehouse_mutation_details.each {|x| x.delete_object }
      self.is_deleted = true 
      self.save 
    end
  end
  
  def all_roller_warehouse_mutation_details_confirmable?
    self.roller_warehouse_mutation_details.each do |x|
      return x.confirmable? if not x.confirmable?
    end
    
    return true 
  end
  
  
  
  def confirm_object( params )
    return if self.is_deleted? 
  
    
    if self.roller_warehouse_mutation_details.count == 0 
      self.errors.add(:generic_errors, "Belum ada detail")
      return self
    end
    
    if self.is_confirmed? 
      self.errors.add(:generic_errors, "Sudah konfirmasi")
      return self 
    end
    
    
    roller_identification_detail_id_array = self.roller_warehouse_mutation_details.map {|x| x.roller_identification_detail_id }
    
    delivered_roller_identification_count = RollerIdentificationDetail.where{
      ( id.in roller_identification_detail_id_array ) & 
      (
        ( is_finished.eq false ) | 
        ( is_delivered.eq true )
      )
    }
    
    if delivered_roller_identification_count != 0 
      self.errors.add(:generic_errors, "Ada roller identification yang sudah terkirim di pengiriman ini")
      return self 
    end
   
    
    if self.all_roller_warehouse_mutation_details_confirmable?
      if not params[:confirmed_at].present?
        self.errors.add(:confirmed_at, "Harus ada tanggal konfirmasi")
        return self
      end
      
      self.is_confirmed = true 
      self.confirmed_at = params[:confirmed_at]
      self.save 
      self.roller_warehouse_mutation_details.each {|x| x.confirm_object( params[:confirmed_at]) }
    else
      self.errors.add(:generic_errors, "Ada roller warehouse_mutation detail yang tidak bisa di konfirmasi")
      return self 
    end
  end
  
  def all_roller_warehouse_mutation_details_unconfirmable?
    self.roller_warehouse_mutation_details.each do |x|
      return  x.unconfirmable? if not x.unconfirmable?
    end
    
    return true 
  end
  
  
  def unconfirm_object 
    return if self.is_deleted?
    
    if not self.is_confirmed? 
      self.errors.add(:generic_errors, "Belum konfirmasi")
      return self 
    end
    
    
    
    if not self.all_roller_warehouse_mutation_details_unconfirmable?
      self.errors.add(:generic_errors, "Ada roller warehouse_mutation detail yang tidak bisa di batalkan ")
      return self 
    end
    
    
    self.is_confirmed = false 
    self.confirmed_at = nil 
    self.save 
    self.roller_warehouse_mutation_details.each {|x| x.unconfirm_object }
  end
  
  def self.active_objects
    self.where(:is_deleted => false )
  end
end
