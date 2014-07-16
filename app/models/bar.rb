

class Bar < ActiveRecord::Base
  
  acts_as :item , :as => :itemable
  
  def self.create_object(params)
    new_object = self.new
    new_object.bar_sku = params[:bar_sku]
    new_object.sku = params[:bar_sku]
    new_object.item_type_id = ItemType.find_by_legacy_code(ITEM_TYPE_CONSTANT[:bar]).id 
    new_object.save 
    
    return new_object
  end
  
  def update_object( params )
    self.bar_sku = params[:bar_sku]
    self.sku = params[:bar_sku]
    self.save 
  end
end

