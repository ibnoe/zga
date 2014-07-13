class CoreBuilder < ActiveRecord::Base
  
  validates_presence_of :used_core_sku, :new_core_sku, :base_core_sku
  
  validate :uniq_used_core_sku
  validate :uniq_new_core_sku 
  validate :uniq_base_core_sku 
  
  def uniq_used_core_sku
    return if not used_core_sku.present?
   
    
    
    total_duplicate_count = Item.where(:sku => self.used_core_sku).count
    
    target = Item.where(:sku => self.used_core_sku).first
    
    if not self.persisted? and total_duplicate_count != 0 
      self.errors.add(:used_core_sku, "Sudah pernah ada 1 ")
      return self 
    end
    
    if target and self.persisted? and target.id != self.used_core.item.id and total_duplicate_count  ==  1 
      self.errors.add(:used_core_sku, "Sudah pernah ada 2")
      return self 
    end
  end
  
  def uniq_new_core_sku
    return if not new_core_sku.present?
    
    total_duplicate_count = Item.where(:sku => self.new_core_sku).count
    target = Item.where(:sku => self.new_core_sku).first
    
    if not self.persisted? and total_duplicate_count != 0 
      self.errors.add(:new_core_sku, "Harus uniq! 1")
      return self 
    end
    
    
    
    if target and self.persisted? and target.id != self.new_core.item.id and total_duplicate_count  ==  1 
      self.errors.add(:new_core_sku, "Harus uniq! 2")
      return self 
    end
  end
  
  def uniq_base_core_sku
    
    return if not base_core_sku.present?
    
    total_duplicate_count = CoreBuilder.where(:base_core_sku => self.base_core_sku).count
    target = CoreBuilder.where(:base_core_sku => self.base_core_sku).first
    
    if not self.persisted? and total_duplicate_count != 0 
      self.errors.add(:base_core_sku, "Harus uniq!")
      return self 
    end
    
    if self.persisted? and target.id != self.id and total_duplicate_count  ==  1 
      self.errors.add(:base_core_sku, "Harus uniq!")
      return self 
    end
  end
  
  def self.create_object(params)
    new_object = self.new 
    new_object.used_core_sku = params[:used_core_sku]         
    new_object.new_core_sku  = params[:new_core_sku  ]
    new_object.base_core_sku = params[:base_core_sku ]
    new_object.description   = params[:description ]

    if new_object.save 
      new_core_object = Core.create_object(
        :core_sku => new_object.new_core_sku 
      )
      
      used_core_object = Core.create_object(
        :core_sku => new_object.used_core_sku
      )
      new_object.new_core_id  = new_core_object.id
      new_object.used_core_id = used_core_object.id
      
      new_object.save 
    end
    return new_object 
  end
  
  def update_object( params ) 
    if self.used_core.stock_mutations.count != 0 
      self.errors.add(:generic_errors, "Sudah ada stock mutasi pada used core")
      return self 
    end
    
    if self.new_core.stock_mutations.count != 0 
      self.errors.add(:generic_errors, "Sudah ada stock mutasi pada new core")
      return self 
    end
    
    self.used_core_sku = params[:used_core_sku]         
    self.new_core_sku  = params[:new_core_sku  ]
    self.base_core_sku = params[:base_core_sku ]
    self.description   = params[:description ]
    
    if self.save
      new_core.update_object(
        :core_sku => self.new_core_sku
      )
      
      used_core.update_object(
        :core_sku => self.used_core_sku
      )
    end
    
    return self 
  end
  
  def used_core
    Core.find_by_id self.used_core_id
  end
  
  def new_core
    Core.find_by_id self.new_core_id
  end
  
  def used_core_item
    used_core.item 
  end
  
  def new_core_item
    new_core.item 
  end
  
  def delete_object
    
    if RollerBuilder.where(:core_builder_id => self.id).count != 0 
      self.errors.add(:generic_errors, "Sudah ada roller builder yang menggunakan core builder ini")
      return self 
    end
    
    if self.used_core.item.stock_mutations.count != 0 
      self.errors.add(:generic_errors, "Sudah ada stock mutasi pada used core")
      return self 
    end
    
    if self.new_core.item.stock_mutations.count != 0 
      self.errors.add(:generic_errors, "Sudah ada stock mutasi pada new core")
      return self 
    end
    
    used_core.destroy
    new_core.destroy 
    self.destroy 
  end
  
  def self.active_objects
    self
  end
end
