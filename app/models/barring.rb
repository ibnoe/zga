


class Barring < ActiveRecord::Base
  
  acts_as :item , :as => :itemable
  has_many :barring_work_order_details 
  
   
  
  validates_presence_of :barring_sku, :left_bar_id, :right_bar_id, :blanket_id   
  validates_uniqueness_of :barring_sku 
  
  validate :ensure_bar_if_bar_is_included

  validate :valid_right_bar_id
  validate :valid_left_bar_id
  validate :valid_blanket_id  
  
  def blanket
    Blanket.find_by_id blanket_id 
  end
  
  def ensure_bar_if_bar_is_included
    return if not  is_bar_included?
    
    if not ( right_bar_id.present? and left_bar_id.present? ) 
      self.errors.add(:generic_errors, "harus ada bar")
      return self 
    end
    
  end
  
  def valid_right_bar_id
    return if not right_bar_id.present?
    
    object = Bar.find_by_id right_bar_id
    if object.nil?
      self.errors.add(:right_bar_id, "Harus ada")
      return self 
    end
  end
  
  def valid_left_bar_id
    return if not left_bar_id.present?
    
    object = Bar.find_by_id left_bar_id
    if object.nil?
      self.errors.add(:left_bar_id, "Harus ada")
      return self 
    end
  end
  
  def valid_blanket_id
    return if not blanket_id.present?
    
    object = Blanket.find_by_id blanket_id
    if object.nil?
      self.errors.add(:blanket_id, "Harus ada")
      return self 
    end
  end
  
  
  def self.create_object(params)
    new_object = self.new
    
    new_object.barring_sku     = params[:barring_sku    ]
    new_object.is_bar_included = params[:is_bar_included]
    new_object.left_bar_id     = params[:left_bar_id    ]
    new_object.right_bar_id    = params[:right_bar_id   ]
    new_object.blanket_id      = params[:blanket_id     ]
    new_object.description     = params[:description] 
    
    
    new_object.sku = params[:barring_sku]
    new_object.item_type_id = ItemType.find_by_legacy_code(ITEM_TYPE_CONSTANT[:barring]).id 
    
    if new_object.save 
      if not new_object.is_bar_included?
        new_object.left_bar_id  = nil 
        new_object.right_bar_id = nil 
        new_object.save 
      end
    end
    
    return new_object
  end
  
  def update_object( params )
    
    self.barring_sku        = params[:barring_sku    ]
    self.is_bar_included    = params[:is_bar_included]
    self.left_bar_id        = params[:left_bar_id    ]
    self.right_bar_id       = params[:right_bar_id   ]
    self.blanket_id         = params[:blanket_id     ]
    self.description = params[:description] 
    
    self.sku = params[:barring_sku]
    
    if self.save 
      if not self.is_bar_included?
        self.left_bar_id  = nil 
        self.right_bar_id = nil 
        self.save 
      end
    end
  end
end

