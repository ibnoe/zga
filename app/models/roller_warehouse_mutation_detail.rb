class RollerWarehouseMutationDetail < ActiveRecord::Base
  belongs_to :roller_warehouse_mutation
  belongs_to :roller_identification_detail 

  
  validates_presence_of  :roller_warehouse_mutation_id , :roller_identification_detail_id 
  validates_uniqueness_of :warehouse_mutation_code 
  
  validate :valid_roller_identification_detail_id
  validate :can_not_create_if_parent_is_confirmed
  validate :roller_identification_detail_must_be_finished_and_not_delivered
  validate :unique_detail
  
  
  def can_not_create_if_parent_is_confirmed
    return if not self.roller_warehouse_mutation_id.present?
    return if self.persisted?
    
    if roller_warehouse_mutation.is_confirmed?
      self.errors.add(:generic_errors, "Roller WarehouseMutation sudah konfirmasi")
      return self 
    end
  end
  
  
  
  def valid_roller_identification_detail_id
    return  if not roller_identification_detail_id.present? 
    object = RollerIdentificationDetail.find_by_id roller_identification_detail_id
    
    if object.nil?
      self.errors.add(:roller_identification_detail_id, "Harus ada dan valid")
      return self 
    end
  end
  
  
  def roller_identification_detail_must_be_finished_and_not_delivered
    return if not roller_identification_detail_id.present? 
    
    if not roller_identification_detail.is_finished?
      self.errors.add(:roller_identification_detail_id, "Belum selesai di proses. Tidak bisa keluar dari warehouse")
      return self 
    end
    
    if  roller_identification_detail.is_delivered?
      self.errors.add(:roller_identification_detail_id, "Sudah keluar warehouse")
      return self 
    end
    
  end
  
  def unique_detail
    return if not roller_identification_detail_id.present? 
    return if not roller_warehouse_mutation_id.present? 
    
    roller_identification_detail_count  = RollerIdentificationDetail.where(
      :roller_warehouse_mutation_id => roller_warehouse_mutation_id,
      :roller_identification_detail_id => roller_identification_detail_id
    ).count 
    
    roller_identification_detail = RollerIdentificationDetail.where(
      :roller_warehouse_mutation_id => roller_warehouse_mutation_id,
      :roller_identification_detail_id => roller_identification_detail_id
    ).first
    
    if self.persisted? and roller_identification_detail.id != self.id   and roller_identification_detail_count == 1
      self.errors.add(:roller_identification_detail_id, "Item harus uniq dalam 1 mutasi roller")
      return self 
    end
    
    # there is item with such item_id in the database
    if not self.persisted? and roller_identification_detail_count != 0 
      self.errors.add(:roller_identification_detail_id, "Item harus uniq dalam 1 mutasi roller")
      return self
    end
  end
   
   
   
  
  def self.create_object( params ) 
    new_object = self.new
    new_object.roller_warehouse_mutation_id = params[:roller_warehouse_mutation_id ]
    new_object.roller_identification_detail_id          = params[:roller_identification_detail_id]  

    new_object.save 
    
    return new_object
  end
  
  
  def update_object(params)
    
    if self.roller_warehouse_mutation.is_confirmed?
      self.errors.add(:generic_errors, "Tidak bisa update. Sudah konfirmasi ")
      return self 
    end
      
    self.roller_identification_detail_id = params[:roller_identification_detail_id ] 
    
     
    self.save
  end
   
  
  
  
  def delete_object
    if  self.roller_warehouse_mutation.is_confirmed?
      self.errors.add(:generic_errors, "Sudah konfirmasi. Tidak bisa delete")
      return self
    end
    
    self.destroy 
  end
  
  
  
  def confirmable? 
    return false if roller_identification_detail.is_delivered?
    return true
  end
  
    
  def item
    roller_identification_detail.item 
  end
  
  def source_warehouse_item
    WarehouseItem.find_or_create_object(
      :item_id => item.id, 
      :warehouse_id => self.roller_warehouse_mutation.source_warehouse_id 
    )
  end
  
  def target_warehouse_item
    WarehouseItem.find_or_create_object(
      :item_id => item.id, 
      :warehouse_id => self.roller_warehouse_mutation.target_warehouse_id 
    )
  end

  
  def confirm_object(confirmation_datetime)
    return self if not self.confirmable?
    
    
  
    
 
    
    
    stock_mutation = StockMutation.create_object( 
      item, # the item 
      self, # source_document_detail 
      STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
      STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
      source_warehouse_item.warehouse_id 
    )
    
    item.update_stock_mutation( stock_mutation ) 
    source_warehouse_item.update_stock_mutation(stock_mutation)
    
    item.reload 
    
    stock_mutation = StockMutation.create_object( 
      item, # the item 
      self, # source_document_detail 
      STOCK_MUTATION_CASE[:addition], # stock_mutation_case,
      STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
      target_warehouse_item.warehouse_id
    )
    
    item.update_stock_mutation( stock_mutation ) 
    source_warehouse_item.update_stock_mutation(stock_mutation)
    
    
    
    
    roller_identification_detail.set_delivery_status(  true ) 
    
    
    
    
  end
  
  def unconfirmable?

    return true 
  end
  
  def unconfirm_object
    return self if not self.unconfirmable?
    
     
    StockMutation.get_by_source_document_detail( self, STOCK_MUTATION_ITEM_CASE[:ready] ).each do |sm|
      sm.item.reverse_stock_mutation( sm )
      sm.warehouse_item.reverse_stock_mutation( sm )
      sm.destroy
    end
     
    roller_identification_detail.set_delivery_status(  false  ) 
    
  end
  
  def self.active_objects
    return self 
  end
  
  
   
end
