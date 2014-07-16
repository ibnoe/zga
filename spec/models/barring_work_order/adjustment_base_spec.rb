require 'spec_helper'

describe RollerWorkOrder do
  before(:each) do
    ItemType.setup_item_type
    @warehouse = Warehouse.create_object(
      :name => "warehouse awesome",
      :description => "Badaboom"
    )
    
    @contact = Contact.create_object(
      :name             => "Contact"           ,
      :description      => "Description"      ,
      :address          =>  "Address"        ,
      :shipping_address => "Shipping Address"
    )
    
     
    @compound_1 = Compound.create_object(
    :compound_sku            => "compo1" 
    )
    
    @barring_sku = "BARR"
    @bar_sku_1 = "BAR_SK_1"
    @bar_1 = Bar.create_object(
    :bar_sku            => @bar_sku_1 
    )
    
    @bar_sku_2 = "BAR_SK_2"
    @bar_2 = Bar.create_object(
    :bar_sku            => @bar_sku_2 
    )
    
    @blanket_sku = "BLANK_1"
    @blanket_1  = Blanket.create_object(
      :blanket_sku => @blanket_sku 
    )
    
    # we need to create initial stock.. 
    
    @bar_1_wh_item = WarehouseItem.find_or_create_object(
      :item_id => @bar_1.item.id,
      :warehouse_id => @warehouse.id 
    )
    
    @bar_2_wh_item = WarehouseItem.find_or_create_object(
      :item_id => @bar_2.item.id,
      :warehouse_id => @warehouse.id 
    )
    
    @blanket_1_wh_item = WarehouseItem.find_or_create_object(
      :item_id => @blanket_1.item.id,
      :warehouse_id => @warehouse.id 
    )
    
    @sa = StockAdjustment.create_object(
      :adjustment_date  => DateTime.now , 
      :description      => "awesome adjustment ",
      :warehouse_id => @warehouse.id
    )
    
    @quantity1 = 100
    @sad_bar_1 = StockAdjustmentDetail.create_object(
      :stock_adjustment_id => @sa.id , 
      :quantity => @quantity1, 
      :item_id => @bar_1.item.id 
    )
    
    @sad_bar_2 = StockAdjustmentDetail.create_object(
      :stock_adjustment_id => @sa.id , 
      :quantity => @quantity1, 
      :item_id => @bar_2.item.id 
    )
    
    @sad_blanket_1 = StockAdjustmentDetail.create_object(
      :stock_adjustment_id => @sa.id , 
      :quantity => @quantity1, 
      :item_id => @blanket_1.item.id 
    )
    
    @sa.confirm_object(:confirmed_at => DateTime.now + 2.days)
    @bar_1      .reload
    @bar_2      .reload
    @blanket_1  .reload
    
  end
  
  # it "should confirm stock_adjustment" do
  #   @sa.is_confirmed.should be_true 
  # end
  # 
  it "should create stock mutations" do
    StockMutation.count.should == 3 
    
    sm_1 = StockMutation.first 
    puts "#{sm_1.inspect}"
    puts "\n\nItem: #{sm_1.item.inspect}"
    
    # puts "\n\nBar: #{sm_1.item.itemable.inspect}"
    # puts "Total ready in itemable: "
  end
  
  
  
  it "should update the ready quantity" do
    @bar_1.item.ready.should == @quantity1
    @bar_2.item.ready.should == @quantity1
    @blanket_1.item.ready.should == @quantity1
  end
   
  
end
