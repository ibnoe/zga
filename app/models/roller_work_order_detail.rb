class RollerWorkOrderDetail < ActiveRecord::Base
  belongs_to :roller_work_order
  belongs_to :roller_identification_detail 
  belongs_to :roller_builder 

  
  validates_presence_of  :roller_work_order_id , :roller_builder_id 
   
  validate :valid_roller_builder_id
  validate :can_not_create_if_parent_is_confirmed
  validate :roller_identification_detail_must_not_be_assigned_to_another_work_order
  validate :roller_identification_detail_must_not_be_finished_or_delivered
  validate :core_builder_must_be_compatible_with_roller_builder
  validate :uniq_roller_identification_detail 
  # validate :enough_available_unidentified_core_for_self_production
  
  
  def quantity 
    1 
  end

  # only useful for stock_mutation 
  def confirmed_at 
    finished_at 
  end
  
  def can_not_create_if_parent_is_confirmed
    return if not self.roller_work_order_id.present?
    return if self.persisted?
    
    if roller_work_order.is_confirmed?
      self.errors.add(:generic_errors, "Roller WorkOrder sudah konfirmasi")
      return self 
    end
  end
  
  
  
  def valid_roller_builder_id
    return  if not roller_builder_id.present? 
    object = RollerBuilder.find_by_id roller_builder_id
    
    if object.nil?
      self.errors.add(:roller_builder_id, "Harus ada dan valid")
      return self 
    end
  end
  
  def roller_identification_detail_must_not_be_assigned_to_another_work_order
    return if not roller_identification_detail_id.present?
    
    current_work_order_detail = roller_identification_detail.assigned_work_order_detail
    
    if current_work_order_detail and roller_identification_detail.is_job_scheduled?  and current_work_order_detail.id != self.id 
      self.errors.add(:roller_identification_detail_id, "Sudah diassign di work order lain")
      return self 
    end
  end
  
  def roller_identification_detail_must_not_be_finished_or_delivered
    return if not roller_identification_detail_id.present?
     
    if roller_identification_detail.is_finished  
      self.errors.add(:roller_identification_detail_id, "Sudah selesai dikerjakan")
      return self 
    end
    
    if roller_identification_detail.is_delivered  
      self.errors.add(:roller_identification_detail_id, "Sudah dikirim")
      return self 
    end
  end
  
  def core_builder_must_be_compatible_with_roller_builder
    return if not roller_builder_id.present? 
    return if not roller_identification_detail_id.present? 
    
    if roller_identification_detail.core_builder.id != roller_builder.core_builder_id
      self.errors.add(:roller_builder_id, "Tidak compatible dengan core yang telah di identifikasi")
      return self 
    end
  end
  
  def uniq_roller_identification_detail
    return if not  roller_identification_detail_id.present? 
    return if not  roller_work_order_id.present? 
    
    object_count  = RollerWorkOrderDetail.where(
      :roller_identification_detail_id => roller_identification_detail_id,
      :roller_work_order_id => roller_work_order_id
    ).count 
    
    object = RollerWorkOrderDetail.where(
      :roller_identification_detail_id => roller_identification_detail_id,
      :roller_work_order_id => roller_work_order_id
    ).first
    
    if object and self.persisted? and object.id != self.id   and object_count == 1
      self.errors.add(:roller_identification_detail_id, "Sudah ada Roller #{roller_identification_detail.identification_code} di work order ini")
      return self 
    end
    
    # there is item with such item_id in the database
    if not self.persisted? and object_count != 0 
      self.errors.add(:roller_identification_detail_id, "Sudah ada Roller #{roller_identification_detail.identification_code} di work order ini")
      return self
    end
  end
   
   
   
  
  def self.create_object( params ) 
    new_object = self.new
    new_object.roller_work_order_id = params[:roller_work_order_id ]
    new_object.roller_builder_id          = params[:roller_builder_id] 
    new_object.roller_identification_detail_id          = params[:roller_identification_detail_id] 

    
    
    new_object.save 
    
    return new_object
  end
  
  
  def update_object(params)
    
    if self.roller_work_order.is_confirmed?
      self.errors.add(:generic_errors, "Tidak bisa update. Sudah konfirmasi ")
      return self 
    end
      
    self.roller_work_order_id = params[:roller_work_order_id ]
    self.roller_builder_id          = params[:roller_builder_id] 
    self.roller_identification_detail_id          = params[:roller_identification_detail_id] 
    
     
    self.save
  end
   
  
  
  
  def delete_object
    if  self.roller_work_order.is_confirmed?
      self.errors.add(:generic_errors, "Sudah konfirmasi. Tidak bisa delete")
      return self
    end
    
    
    self.destroy 
  end
  
  
  
  def confirmable? 
    roller_identification_detail_must_not_be_assigned_to_another_work_order
    return false if self.errors.size != 0 
    return true
  end
  
   
   
  def target_item
    if roller_identification_detail.is_new_core? 
      self.roller_builder.roller_new_core_item
    else
      self.roller_builder.roller_used_core_item
    end
  end
  
  def source_item
    roller_identification_detail.item 
  end

  
  def confirm_object(confirmation_datetime)
    
    
    now = roller_work_order.created_at 
    year = now.year
    month = now.month 
    
    
    beginning_of_the_month_datetime = now.beginning_of_month
    end_of_the_month_datetime = (now + 1.months).beginning_of_month - 1.second
    
    total_item_created_in_current_month = self.class.where(
      :created_at => beginning_of_the_month_datetime..end_of_the_month_datetime
    ).count 
    
    self.code = "#{year}/#{month}/#{total_item_created_in_current_month}"
    self.save
    
 
    roller_identification_detail.set_job_scheduled(  true ) 
    
    
    
  end
  
  def unconfirmable?
    return false if  self.is_finished?  or self.is_rejected? 

    return true 
  end
  
  def unconfirm_object
    return self if not self.unconfirmable?
    
    self.code = nil 
    self.save
    roller_identification_detail.set_job_scheduled(  false  ) 
    
    
    
    
  end
  
  def self.active_objects
    return self 
  end
  
  def target_warehouse_item
    WarehouseItem.find_or_create_object(
      :warehouse_id => self.roller_identification_detail.roller_identification.warehouse_id,
      :item_id => target_item.id 
    )
  end
  
  def source_warehouse_item
    WarehouseItem.find_or_create_object(
      :warehouse_id => self.roller_identification_detail.roller_identification.warehouse_id,
      :item_id => roller_identification_detail.item.id 
    )
  end
  
  
  def finish_object( params ) 
    if not self.roller_work_order.is_confirmed?
      self.errors.add(:generic_errors, "Work Order belum konfirmasi")
      return self 
    end
    
    if self.is_finished?
      self.errors.add(:generic_errors, "Sudah selesai")
      return self 
    end
    
 
    
    stock_mutation = StockMutation.create_object( 
      target_item, # the item 
      self, # source_document_detail 
      STOCK_MUTATION_CASE[:addition], # stock_mutation_case,
      STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
      roller_work_order.roller_identification.warehouse_id 
    )
    
    target_item.update_stock_mutation( stock_mutation ) 
    
    target_warehouse_item.update_stock_mutation(stock_mutation) 
    
    stock_mutation = StockMutation.create_object( 
      source_item, # the item 
      self, # source_document_detail 
      STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
      STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
      roller_work_order.roller_identification.warehouse_id 
    )
    
    source_item.update_stock_mutation( stock_mutation ) 
    source_warehouse_item.update_stock_mutation(stock_mutation)
    
    self.is_finished = true 
    self.finished_at = params[:finished_at]
    self.save
     
    roller_identification_detail.set_finish_status( true ) 
    
    
  end
  
  
  def unfinish_object 
    
    
    if not self.is_finished?
      self.errors.add(:generic_errors, "Belum ada penyelesaian")
      return self 
    end
    
    if self.roller_identification_detail.is_delivered?
      self.errors.add(:generic_errors, "Sudah ada pengiriman")
    end
    
    # if it is delivered, can't be unfinished 
     
    
 
    StockMutation.get_by_source_document_detail( self, STOCK_MUTATION_ITEM_CASE[:ready] ).each do |sm|
      sm.item.reverse_stock_mutation( sm )
      sm.warehouse_item.reverse_stock_mutation( sm )
      sm.destroy
      
      
    end
    
    
   
    self.is_finished = false  
    self.finished_at =  nil 
    self.save
     
    roller_identification_detail.set_finish_status( false  ) 
    
  end
  
   
end
