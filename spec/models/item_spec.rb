require 'spec_helper'

describe Item do
  before(:each) do
    @item_type = ItemType.create_object(
      :name => "Others",
      :description => "on off item"
    )
    @item = Item.create_object(
      :sku => "34242wafaw",
      :description => "awesome item",
      :item_type_id => @item_type.id 
    )
  end
  
  it "should create unique SKU" do
    @item.should be_valid 
    
  end
  
  it "should allow self update" do
    @item.update_object(
      :sku => "34242wafaw",
      :description => "awesome item"
    )
    
    @item.errors.size.should == 0 
    
  end
  
  it "should not allow equal sku" do
    @item2 = Item.create_object(
      :sku => "34242wafaw",
      :description => "awesome item",
      :item_type_id => @item_type.id 
    )
    
    @item2.errors.size.should_not == 0 
  end
end
