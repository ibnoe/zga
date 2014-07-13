require 'spec_helper'

describe StockAdjustmentDetail do
  before(:each) do
    @warehouse = Warehouse.create_object(
      :name => "warehouse awesome",
      :description => "Badaboom"
    )
    
    @item_type = ItemType.create_object(
      :name => "Others",
      :description => "on off item"
    )
    
    @item1 = Item.create_object(
      :sku => "34242wafaw",
      :description => "awesome item",
      :item_type_id => @item_type.id 
    )
    
    @item2 = Item.create_object(
      :sku => "2234242wafaw",
      :description => "awesome item 22",
      :item_type_id => @item_type.id
    )
   
  end
  
  it "should create warehouse item" do
    warehouse_item = WarehouseItem.create_object(
      :item_id => @item1.id,
      :warehouse_id => @warehouse.id
    )
    
    warehouse_item.should be_valid 
  end
  
  it "should create warehouse item in find or create object" do
    warehouse_item = WarehouseItem.find_or_create_object(
      :item_id => @item1.id,
      :warehouse_id => @warehouse.id
    )
    
    warehouse_item.should be_valid
  end
   
end
