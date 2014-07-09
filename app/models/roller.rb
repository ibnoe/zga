
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
end

