class RollerIdentificationDetail < ActiveRecord::Base
  belongs_to :roller_identification
  has_many :roller_work_order_details 
  
  belongs_to :core_builder

  
  validates_presence_of  :roller_identification_id , :core_builder_id, :identification_code 
  validates_uniqueness_of :identification_code 
  
  validate :valid_core_builder_id
  validate :can_not_create_if_parent_is_confirmed
  # validate :enough_available_unidentified_core_for_self_production
  
  
  def quantity
    1
  end
  
  def confirmed_at
    self.roller_identification.confirmed_at
  end
  
  def can_not_create_if_parent_is_confirmed
    return if not self.roller_identification_id.present?
    return if self.persisted?
    
    if roller_identification.is_confirmed?
      self.errors.add(:generic_errors, "Roller Identification sudah konfirmasi")
      return self 
    end
  end
  
  
  
  def valid_core_builder_id
    return  if not core_builder_id.present? 
    object = CoreBuilder.find_by_id core_builder_id
    
    if object.nil?
      self.errors.add(:core_builder_id, "Harus ada dan valid")
      return self 
    end
  end
  
  def warehouse_item
    return if not roller_identification_id.present? 
  
  
    
    WarehouseItem.find_or_create_object(
      :item_id => self.item.id ,
      :warehouse_id =>  self.roller_identification.warehouse_id
    )
     
  end
  
   
   
  
  def self.create_object( params ) 
    
      
    
    new_object = self.new
    new_object.roller_identification_id = params[:roller_identification_id ]
    new_object.core_builder_id          = params[:core_builder_id]
    new_object.is_new_core              = params[:is_new_core]
    new_object.identification_code      = ( params[:identification_code].present? ? params[:identification_code   ].to_s.upcase : nil )
    new_object.description              = params[:description] 

    
    
    new_object.save 
    
    return new_object
  end
  
  
  def update_object(params)
    
    if self.roller_identification.is_confirmed?
      self.errors.add(:generic_errors, "Tidak bisa update. Sudah konfirmasi ")
      return self 
    end
      
    self.core_builder_id          = params[:core_builder_id]
    self.is_new_core              = params[:is_new_core]
    self.identification_code      = ( params[:identification_code].present? ? params[:identification_code   ].to_s.upcase : nil )
    self.description              = params[:description]
     
    self.save
  end
   
  
  
  
  def delete_object
    if not self.roller_identification.is_confirmed?
      self.destroy 
    else
      self.errors.add(:generic_errors, "Sudah konfirmasi. Tidak bisa delete")
      return self 
    end
  end
  
  
  
  def confirmable? 
    return true
  end
  
   
  def item
    if self.is_new_core?
      core_builder.new_core_item
    else
      core_builder.used_core_item 
    end
  end
  
  def confirm_object(confirmation_datetime)
    return self if not self.confirmable?
    
    
    if self.roller_identification.is_self_production? 
      # nothing 
    else
      
      
      stock_mutation = StockMutation.create_object( 
        item, # the item 
        self, # source_document_detail 
        STOCK_MUTATION_CASE[:addition], # stock_mutation_case,
        STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
        roller_identification.warehouse_id 
       )

      item.update_stock_mutation( stock_mutation ) 
       
      warehouse_item.update_stock_mutation(stock_mutation) 
 
      self.save
      
    end
    
    
     
  end
  
  def assigned_work_order_detail
    return nil if self.is_job_scheduled? 
    
    self.roller_work_order_details.where(:is_rejected => false).first 
  end
  
  def unconfirmable?
    return false if self.roller_work_order_details.count != 0 

    return true 
  end
  
  def unconfirm_object
    return self if not self.unconfirmable?
    
    
    StockMutation.get_by_source_document_detail( self, STOCK_MUTATION_ITEM_CASE[:ready] ).each do |sm|
      sm.item.reverse_stock_mutation( sm )
      sm.warehouse_item.reverse_stock_mutation( sm )
      sm.destroy
      
      item.reload
      warehouse_item.reload
    end
     
    
  end
  
  def self.active_objects
    return self 
  end
  
  def set_job_scheduled( value ) 
    self.is_job_scheduled = value
    self.save 
  end
  
  def set_finish_status( value )
    self.is_finished = value
    self.save 
  end
  
  def set_delivery_status( value ) 
    self.is_delivered = value
    self.save 
  end
  

  
  
   
end
