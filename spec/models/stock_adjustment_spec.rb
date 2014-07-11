require 'spec_helper'

describe StockAdjustment do
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
  
  it "should create 2 items" do
    Item.count.should ==  2
  end
  
  context "creating stock adjustment " do
    before(:each) do
      @stock_adjustment = StockAdjustment.create_object(
        :adjustment_date  => DateTime.now , 
        :description      => "awesome adjustment ",
        :warehouse_id => @warehouse.id
        
      )
    end
    
    it "should create valid stock_adjustment" do
      @stock_adjustment.should be_valid 
    end
    
    it "should not allow confirmation" do 
      @stock_adjustment.confirm_object(
        :confirmed_at => DateTime.now + 2.days 
      )
      
      @stock_adjustment.errors.size.should_not == 0 
      @stock_adjustment.reload 
      @stock_adjustment.is_confirmed.should be_false 
    end
  end
end
