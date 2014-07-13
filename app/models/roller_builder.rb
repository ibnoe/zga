class RollerBuilder < ActiveRecord::Base
  has_many :roller_work_order_details
  
  validates_presence_of :roller_used_core_sku, :roller_new_core_sku , :base_roller_sku, :core_builder_id, :compound_id
  
  validate :uniq_roller_used_core_sku
  validate :uniq_roller_new_core_sku 
  validate :uniq_base_roller_sku 
  validate :valid_core_builder_id 
  validate :valid_compound_id
   
  
  def uniq_roller_used_core_sku
    return if not roller_used_core_sku.present?
    
    total_duplicate_count = Item.where(:sku => self.roller_used_core_sku).count
    target = Item.where(:sku => self.roller_used_core_sku).first
    
    if not self.persisted? and total_duplicate_count != 0 
      self.errors.add(:roller_used_core_sku, "Sudah pernah ada 1")
      return self 
    end
    
    if target and self.persisted? and target.id != self.roller_used_core.item.id and total_duplicate_count  ==  1 
      self.errors.add(:roller_used_core_sku, "Sudah pernah ada 2")
      return self 
    end
  end
  
  def uniq_roller_new_core_sku
    return if not roller_new_core_sku.present?

    total_duplicate_count = Item.where(:sku => self.roller_new_core_sku).count
    target = Item.where(:sku => self.roller_new_core_sku).first
    
    if not self.persisted? and total_duplicate_count != 0 
      self.errors.add(:roller_new_core_sku, "Harus uniq! 1 ")
      return self 
    end
    
    if target and self.persisted? and target.id != self.roller_new_core.item.id and total_duplicate_count  ==  1 
      self.errors.add(:roller_new_core_sku, "Harus uniq! 2")
      return self 
    end
  end
  
  def uniq_base_roller_sku
    
    return if not base_roller_sku.present?
    
    total_duplicate_count = RollerBuilder.where(:base_roller_sku => self.base_roller_sku).count
    target = RollerBuilder.where(:base_roller_sku => self.base_roller_sku).first
    
    if not self.persisted? and total_duplicate_count != 0 
      self.errors.add(:base_roller_sku, "Harus uniq!")
      return self 
    end
    
    if self.persisted? and target.id != self.id and total_duplicate_count  ==  1 
      self.errors.add(:base_roller_sku, "Harus uniq!")
      return self 
    end
  end
  
  
  
  def valid_core_builder_id
    return if not core_builder_id.present?
    
    object = CoreBuilder.find_by_id core_builder_id
    if object.nil?
      self.errors.add(:generic_errors, "Tidak boleh kosong")
      return self 
    end
  end
  
  def valid_compound_id
    return if not compound_id.present?
    
    object = Compound.find_by_id compound_id
    if object.nil?
      self.errors.add(:generic_errors, "Tidak boleh kosong")
      return self 
    end
  end
  
  
  
  def self.create_object(params)
    new_object = self.new 
    new_object.roller_used_core_sku = params[:roller_used_core_sku]         
    new_object.roller_new_core_sku  = params[:roller_new_core_sku  ]
    new_object.base_roller_sku = params[:base_roller_sku ]
    new_object.compound_id = params[:compound_id ]
    new_object.description   = params[:description ]
    new_object.core_builder_id = params[:core_builder_id]

    if new_object.save 
      roller_new_core_object = Roller.create_object(
        :roller_sku => new_object.roller_new_core_sku
      )
      
      roller_used_core_object = Roller.create_object(
        :roller_sku => new_object.roller_used_core_sku
      )
      new_object.roller_new_core_id  = roller_new_core_object.id
      new_object.roller_used_core_id = roller_used_core_object.id
      
      new_object.save 
    end
    return new_object 
  end
  
  def update_object( params ) 
    if self.roller_work_order_details.count != 0 
      self.errors.add(:generic_errors, "sudah ada recovery work order yang menggunakan roller builder ini")
      return self 
    end
    
    if self.roller_used_core.stock_mutations.count != 0 
      self.errors.add(:generic_errors, "Sudah ada stock mutasi pada used core")
      return self 
    end
    
    if self.roller_new_core.stock_mutations.count != 0 
      self.errors.add(:generic_errors, "Sudah ada stock mutasi pada new core")
      return self 
    end
    
    self.roller_used_core_sku = params[:roller_used_core_sku]         
    self.roller_new_core_sku  = params[:roller_new_core_sku  ]
    self.base_roller_sku = params[:base_roller_sku ]
    self.compound_id = params[:compound_id ]
    self.description   = params[:description ]
    self.core_builder_id = params[:core_builder_id]
    
    if self.save
      roller_new_core.update_object(
        :roller_sku => self.roller_new_core_sku
      )
      
      roller_used_core.update_object(
        :roller_sku => self.roller_used_core_sku
      )
    end
    
    return self 
  end
  
  def roller_used_core
    Roller.find_by_id self.roller_used_core_id
  end
  
  def roller_new_core
    Roller.find_by_id self.roller_new_core_id
  end
  
  def delete_object
    if self.roller_used_core.stock_mutations.count != 0 
      self.errors.add(:generic_errors, "Sudah ada stock mutasi pada roller dari used core")
      return self 
    end
    
    if self.roller_new_core.stock_mutations.count != 0 
      self.errors.add(:generic_errors, "Sudah ada stock mutasi pada roller dari new core")
      return self 
    end
    
    roller_used_core.destroy
    roller_new_core.destroy 
    
    self.destroy 
  end
  
  def self.active_objects
    self
  end
end
