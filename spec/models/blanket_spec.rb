require 'spec_helper'

describe Blanket do
  before(:each) do
    ItemType.setup_item_type
  end
   
  
  it "should be allowed to create blanket" do
    @blanket = Blanket.create_object(
      :blanket_sku => "Awesome sku"
    )
    
    @blanket.should be_valid 
    
  end
end
