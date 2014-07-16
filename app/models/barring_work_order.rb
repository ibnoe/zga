class BarringWorkOrder < ActiveRecord::Base
  has_many :barring_work_order_details   
  belongs_to :warehouse 
  
  
  validates_presence_of :work_order_date 
  validates_presence_of :warehouse_id
  
  validate :valid_warehouse_id
  
  def valid_warehouse_id
    return  if not warehouse_id.present? 
    object = Warehouse.find_by_id warehouse_id
    
    if object.nil?
      self.errors.add(:warehouse_id, "Harus ada dan valid")
    end
  end
  
  
  
  def self.create_object( params ) 
    new_object = self.new
    new_object.work_order_date = params[:work_order_date]
    new_object.description = params[:description]
    new_object.warehouse_id = params[:warehouse_id]
    if new_object.save 
      now = new_object.created_at
      year = now.year
      month = now.month 
      
      
      beginning_of_the_month_datetime = now.beginning_of_month
      end_of_the_month_datetime = (now + 1.months).beginning_of_month - 1.second
      
      total_item_created_in_current_month = self.where(
        :created_at => beginning_of_the_month_datetime..end_of_the_month_datetime
      ).count 
      
      new_object.code = "#{year}/#{month}/#{total_item_created_in_current_month}"
      new_object.save
    end
    
    return new_object 
  end
  
  def update_object(params )
    if self.is_confirmed?
      self.errors.add(:generic_errors, "Sudah Konfirmasi")
      return self 
    end
    
    
    self.work_order_date = params[:work_order_date]
    self.description = params[:description]
    self.warehouse_id = params[:warehouse_id]
    self.save 
    
    return self
  end
  
  def all_barring_work_order_details_deletable?
    self.barring_work_order_details.each do |x|
      return x.deletable? if not x.deletable?
    end
    
    return true
  end
  
  
  def delete_object
    if self.is_confirmed?
      self.errors.add(:generic_errors, "sudah di konfirmasi")
      return self
    else
      self.barring_work_order_details.each {|x| x.delete_object}
      self.is_deleted = true  
      self.save 
    end
  end
  
  def all_barring_work_order_details_confirmable?
    self.barring_work_order_details.each do |x|
      return x.confirmable? if not x.confirmable?
    end
    
    return true 
  end
  
  
  
  def confirm_object( params )
    return if self.is_deleted? 
    
    if self.barring_work_order_details.count == 0 
      self.errors.add(:generic_errors, "Belum ada detail")
      return self
    end
    
    if self.is_confirmed? 
      self.errors.add(:generic_errors, "Sudah konfirmasi")
      return self 
    end
    
    if self.all_barring_work_order_details_confirmable?
      if not params[:confirmed_at].present?
        self.errors.add(:confirmed_at, "Harus ada tanggal konfirmasi")
        return self
      end
      
      self.is_confirmed = true 
      self.confirmed_at = params[:confirmed_at]
      self.save 
      self.barring_work_order_details.each {|x| x.confirm_object( params[:confirmed_at]) }
    else
      self.errors.add(:generic_errors, "Ada stock adjustment detail yang tidak bisa di konfirmasi")
      return self 
    end
  end
  
  def all_barring_work_order_details_unconfirmable?
    self.barring_work_order_details.each do |x|
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
    
    if self.all_barring_work_order_details_unconfirmable?
      
      self.is_confirmed = false 
      self.confirmed_at = nil 
      self.save 
      self.barring_work_order_details.each {|x| x.unconfirm_object }
    else
      self.errors.add(:generic_errors, "Ada stock adjustment detail yang tidak bisa di batalkan ")
      return self 
    end
  end
  
  def self.active_objects
    self.where(:is_deleted => false )
  end
end
