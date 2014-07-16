

class Blanket < ActiveRecord::Base
  
  acts_as :item , :as => :itemable
  
  def self.create_object(params)
    new_object = self.new
    new_object.blanket_sku = params[:blanket_sku]
    new_object.sku = params[:blanket_sku]
    new_object.item_type_id = ItemType.find_by_legacy_code(ITEM_TYPE_CONSTANT[:blanket]).id 
    new_object.save 
    
    return new_object
  end
  
  def update_object( params )
    self.blanket_sku = params[:blanket_sku]
    self.sku = params[:blanket_sku]
    self.save 
  end
end

