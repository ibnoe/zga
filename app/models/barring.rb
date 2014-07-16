


class Barring < ActiveRecord::Base
  
  acts_as :item , :as => :itemable
  
  def self.create_object(params)
    new_object = self.new
    new_object.barring_sku = params[:barring_sku]
    new_object.sku = params[:barring_sku]
    new_object.item_type_id = ItemType.find_by_legacy_code(ITEM_TYPE_CONSTANT[:barring]).id 
    new_object.description = params[:description]
    new_object.save 
    
    return new_object
  end
  
  def update_object( params )
    self.barring_sku = params[:barring_sku]
    self.sku = params[:barring_sku]
    self.description = params[:description]
    self.save 
  end
end

