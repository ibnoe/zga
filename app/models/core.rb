=begin
  # core extends item 

  roller = Roller.new
  roller.sku = "awesome sku"
  roller.description = "awesome descriptio"
  roller.item_type_id = ItemType.first.id 
  roller.roller_code = "boombastic"
  roller.save 
=end


class Core < ActiveRecord::Base
  acts_as :item , :as => :itemable
  
  def self.create_object(params)
    new_object = Core.new
    new_object.core_sku = params[:core_sku]
    new_object.sku = params[:core_sku]
    new_object.item_type_id = ItemType.find_by_legacy_code ITEM_TYPE_CONSTANT[:core]
    new_object.is_legacy = true 
    new_object.save 
  end
  
  def update_object( params )
    self.core_sku = params[:core_sku]
    self.sku = params[:core_sku]
    self.save 
  end
end


