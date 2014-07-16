require 'spec_helper'

describe Bar do
  before(:each) do
    ItemType.setup_item_type
  end
   
  
  it "should be allowed to create bar" do
    @bar = Bar.create_object(
      :bar_sku => "Awesome sku"
    )
    
    @bar.should be_valid 
    
  end
end
