
=begin
  roller = Roller.new
  roller.sku = "awesome sku"
  roller.description = "awesome descriptio"
  roller.item_type_id = ItemType.first.id 
  roller.roller_code = "boombastic"
  roller.save 
=end



class Roller < ActiveRecord::Base
  
  acts_as :item , :as => :itemable
  
  def self.create_object(params)
    new_object = self.new
    new_object.roller_sku = params[:roller_sku]
    new_object.sku = params[:roller_sku]
    new_object.item_type_id = ItemType.find_by_legacy_code(ITEM_TYPE_CONSTANT[:roller]).id 
    new_object.save 
    
    return new_object
  end
  
  def update_object( params )
    self.roller_sku = params[:roller_sku]
    self.sku = params[:roller_sku]
    self.save 
  end
end

