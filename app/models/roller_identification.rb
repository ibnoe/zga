=begin
  Actually, there are 2 process: 
  1. receiving the goods
  2. 
=end

class RollerIdentification < ActiveRecord::Base
  has_many :roller_identification_details 
  belongs_to :warehouse 
  
  belongs_to :contact
  
  validates_presence_of :identification_date
  validates_presence_of :warehouse_id
  
  validate :valid_warehouse_id
  validate :valid_contact_id 
  validate :valid_contact_and_target_production_status
  
  def valid_warehouse_id
    return if not  warehouse_id.present? 
    
    object = Warehouse.find_by_id warehouse_id 
    
    if object.nil?
      self.errors.add(:warehouse_id, "Harus valid")
      return self 
    end
    
  end
  
  def valid_contact_id
    return if not contact_id.present?
    object = Contact.find_by_id contact_id 
    
    if object.nil?
      self.errors.add(:contact_id, "Harus valid")
      return self 
    end
  end
  
  def valid_contact_and_target_production_status
    if is_self_production.true? and contact_id.present? 
      contact = Contact.find_by_id contact_id 
      
      if contact.nil?
        self.errors.add(:contact_id, "Harus ada jika produksi untuk zengra")
        return self 
      end
    end
  end
   
  
  
  def self.create_object( params ) 
    new_object = self.new
    new_object.identification_date = params[:identification_date]
    new_object.description         = params[:description]
    new_object.warehouse_id        = params[:warehouse_id]
    new_object.contact_id          = params[:contact_id]
    new_object.is_self_production  = params[:is_self_production]
    new_object.description         = params[:description]

    
    if new_object.save 
      now = DateTime.now
      year = now.year
      month = now.month 
      
      
      beginning_of_the_month_datetime = now.beginning_of_month
      end_of_the_month_datetime = (now + 1.months).beginning_of_month - 1.second
      
      total_item_created_in_current_month = self.where(
        :identification_date => beginning_of_the_month_datetime..end_of_the_month_datetime
      ).count 
      
      new_object.code = "#{year}/#{month}/#{total_item_created_in_current_year}"
      new_object.save
       
      
    end
    
    return new_object 
  end
  
  def update_object(params )
    if self.is_confirmed?
      self.errors.add(:generic_errors, "Sudah Konfirmasi")
      return self 
    end
    
    if self.roller_identification_details.count != 0 
      self.errors.add(:generic_errors, "sudah ada identifikasi")
      return self 
    end
    
    self.identification_date = params[:identification_date]
    self.description         = params[:description]
    self.warehouse_id        = params[:warehouse_id]
    self.contact_id          = params[:contact_id]
    self.is_self_production  = params[:is_self_production]
    self.description         = params[:description]
    
    self.save 
    
    return self
  end
  
  def all_roller_identification_details_deletable?
    self.roller_identification_details.each do |x|
      return x.deletable? if not x.deletable?
    end
    
    return true
  end
  
  
  def delete_object
    if self.is_confirmed?
      self.errors.add(:generic_errors, "sudah di konfirmasi")
      return self
    else
      self.roller_identification_details.each {|x| x.delete_object }
      self.is_deleted = true 
      self.save 
    end
  end
  
  def all_roller_identification_details_confirmable?
    self.roller_identification_details.each do |x|
      return x.confirmable? if not x.confirmable?
    end
    
    return true 
  end
  
  
  
  def confirm_object( params )
    return if self.is_deleted? 
  
    
    if self.roller_identification_details.count == 0 
      self.errors.add(:generic_errors, "Belum ada detail")
      return self
    end
    
    if self.is_confirmed? 
      self.errors.add(:generic_errors, "Sudah konfirmasi")
      return self 
    end
    
   
    
    
    if roller_identification_details.count != 0  and is_self_production == true 
      all_possible_id_array = roller_identification_details.map{|x| x.item.id  }
      grouper = all_possible_id_array.uniq
      hash = {} 
      grouper.each {|x| hash[x] = 0  }
      
      all_possible_id_array.each do |x|
        hash[x] += 1 
      end
      
    
      hash.each do |key,value|
        warehouse_item = WarehouseItem.find_or_create_object( 
          :item_id => key ,
          :warehouse_id => self.warehouse_id 
        ) 
        
        if warehouse_item.ready  < value
          self.errors.add(:generic_errors, "Tidak cukup item #{warehouse_item.item.sku}")
          return self 
        end
      end
    end
    
    
    if self.all_roller_identification_details_confirmable?
      if not params[:confirmed_at].present?
        self.errors.add(:confirmed_at, "Harus ada tanggal konfirmasi")
        return self
      end
      
      self.is_confirmed = true 
      self.confirmed_at = params[:confirmed_at]
      self.save 
      self.roller_identification_details.each {|x| x.confirm_object( params[:confirmed_at]) }
    else
      self.errors.add(:generic_errors, "Ada roller identification detail yang tidak bisa di konfirmasi")
      return self 
    end
  end
  
  def all_roller_identification_details_unconfirmable?
    self.roller_identification_details.each do |x|
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
    
    if self.roller_warehouse_mutations.where(:is_deleted => false ).count != 0
      self.errors.add(:generic_errors, "Sudah ada roller yang berpindah")
      return self 
    end
    
    
    if roller_identification_details.count != 0  and is_self_production == false 
      all_possible_id_array = roller_identification_details.map{|x| x.item.id  }
      grouper = all_possible_id_array.uniq
      hash = {} 
      grouper.each {|x| hash[x] = 0  }
      
      all_possible_id_array.each do |x|
        hash[x] += 1 
      end
      
    
      hash.each do |key,value|
        warehouse_item = WarehouseItem.find_or_create_object( 
          :item_id => key ,
          :warehouse_id => self.warehouse_id 
        ) 
        
        if warehouse_item.ready - value < 0 
          self.errors.add(:generic_errors, "Tidak cukup item #{warehouse_item.item.sku}")
          return self 
        end
      end
    end
    
    
    if not self.all_roller_identification_details_unconfirmable?
      self.errors.add(:generic_errors, "Ada roller identification detail yang tidak bisa di batalkan ")
      return self 
    end
    
    
    self.is_confirmed = false 
    self.confirmed_at = nil 
    self.save 
    self.roller_identification_details.each {|x| x.unconfirm_object }
  end
  
  def self.active_objects
    self.where(:is_deleted => false )
  end
end
