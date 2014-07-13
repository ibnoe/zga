require 'spec_helper'

describe Roller do
  before(:each) do
    ItemType.setup_item_type
  end
   
  it "should be allowed to create roller" do
    @roller = Roller.create_object(
      :roller_sku => "Awesome sku"
    )
    
    @roller.should be_valid 
    
  end
end
