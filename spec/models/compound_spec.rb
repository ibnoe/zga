require 'spec_helper'

describe Compound do
  before(:each) do
    ItemType.setup_item_type
  end
   
  it "should be allowed to create compound" do
    @compound = Compound.create_object(
      :compound_sku => "Awesome sku"
    )
    
    @compound.should be_valid 
    
  end
end
