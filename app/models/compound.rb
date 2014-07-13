
class Compound < ActiveRecord::Base
  
  acts_as :item , :as => :itemable
  
  def self.create_object(params)
    new_object = self.new
    new_object.compound_sku = params[:compound_sku]
    new_object.sku = params[:compound_sku]
    new_object.item_type_id = ItemType.find_by_legacy_code(ITEM_TYPE_CONSTANT[:compound]).id 
    new_object.save 
    
    return new_object
  end
  
  def update_object( params )
    self.compound = params[:compound_sku]
    self.sku = params[:compound_sku]
    self.save 
  end
end

