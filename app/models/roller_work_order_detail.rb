class RollerWorkOrderDetail < ActiveRecord::Base
  belongs_to :roller_work_order

  
  validates_presence_of  :roller_work_order_id , :roller_builder_id 
  validates_uniqueness_of :work_order_code 
  
  validate :valid_roller_builder_id
  validate :can_not_create_if_parent_is_confirmed
  # validate :enough_available_unidentified_core_for_self_production
  
  
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
    if not self.roller_work_order.is_confirmed?
      self.destroy 
    else
      self.errors.add(:generic_errors, "Sudah konfirmasi. Tidak bisa delete")
      return self 
    end
  end
  
  
  
  def confirmable? 
    return false if roller_identification_detail.is_job_scheduled?
    return true
  end
  
   
   
  def target_item
    if roller_identification_detail.is_new_core? 
      RollerBuilder.roller_new_core
    else
      RollerBuilder.roller_used_core
    end
  end
  
  def source_item
    roller_identification_detail.item 
  end

  
  def confirm_object(confirmation_datetime)
    return self if not self.confirmable?
    
    
    now = confirmation_datetime
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
    return false if  self.is_finished? or self.is_delivered?

    return true 
  end
  
  def unconfirm_object
    return self if not self.unconfirmable?
    
    self.code = nil 
    self.save
    roller_identification_detail.set_job_scheduled(  false  ) 
    
    
    # self.is_confirmed = false 
    # self.confirmed_at = nil 
    # self.save
    

    
    
  end
  
  def self.active_objects
    return self 
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
    
    item.update_stock_mutation( stock_mutation ) 
    warehouse_item.update_stock_mutation(stock_mutation) 
    
    stock_mutation = StockMutation.create_object( 
      source_item, # the item 
      self, # source_document_detail 
      STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
      STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
      roller_work_order.roller_identification.warehouse_id 
    )
    
    item.update_stock_mutation( stock_mutation ) 
    warehouse_item.update_stock_mutation(stock_mutation)
    
    self.is_finished = true 
    self.finished_at = params[:finished_at]
    self.save
     
    roller_identification_detail.set_finish_status( true ) 
    
    
  end
  
  def unfinish_object( params ) 
    
    
    if not self.is_finished?
      self.errors.add(:generic_errors, "Belum ada penyelesaian")
      return self 
    end
    
    if self.roller_identification_detail.is_delivered?
      self.errors.add(:generic_errors, "Sudah ada pengiriman")
    end
    
    # if it is delivered, can't be unfinished 
    
 
    StockMutation.get_by_source_document_detail( self, STOCK_MUTATION_ITEM_CASE[:ready] ).each do |sm|
      item.reverse_stock_mutation( sm )
      warehouse_item.reverse_stock_mutation( sm )
      sm.destroy
      
      item.reload
      warehouse_item.reload 
    end
    
    
   
    self.is_finished = false  
    self.finished_at =  nil 
    self.save
     
    roller_identification_detail.set_finish_status( false  ) 
    
    
  end
  
   
end
