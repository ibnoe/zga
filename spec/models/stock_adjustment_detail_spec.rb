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
    
    @stock_adjustment = StockAdjustment.create_object(
      :adjustment_date  => DateTime.now , 
      :description      => "awesome adjustment ",
      :warehouse_id => @warehouse.id
    )
  end
  
  it "should create the required objects" do
    @item1.should be_valid
    @item2.should be_valid
    @stock_adjustment.should be_valid 
  end
  
  context "create stock_adjustment_detail" do
    before(:each) do
      @quantity1 = 5
      @soe = StockAdjustmentDetail.create_object(
        :stock_adjustment_id => @stock_adjustment.id , 
        :quantity => @quantity1, 
        :item_id => @item1.id 
      )
    end
    
    it "Should create stock_adjustment_detail" do
      @soe.should be_valid 
    end
    
    context "confirm stock_adjustment" do
      before(:each) do
        @item1.reload
        @initial_item1_ready = @item1.ready 
        
        @stock_adjustment.reload
        @stock_adjustment.confirm_object(
          :confirmed_at => DateTime.now + 2.days
        )
      end
      
      it "should confirm stock_adjustment" do
        @stock_adjustment.reload
        @stock_adjustment.is_confirmed.should be_true 
      end
      
      it "should increase item_quantity " do
        @item1.reload 
        diff = @item1.ready  - @initial_item1_ready 
        diff.should == @quantity1 
      end
    end
  end
end
