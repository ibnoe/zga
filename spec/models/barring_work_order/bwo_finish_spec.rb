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
    
    @barring_1 = Barring.create_object(
      :barring_sku     => @barring_sku,
      :is_bar_included => true ,
      :left_bar_id     => @bar_1.id,
      :right_bar_id    => @bar_2.id ,
      :blanket_id      =>  @blanket_1.id ,
      :description     => "Awesome description"
    )
    
    @barring_2 = Barring.create_object(
      :barring_sku     => @barring_sku + "22",
      :is_bar_included => false ,
      :left_bar_id     => @bar_1.id,
      :right_bar_id    => @bar_2.id ,
      :blanket_id      =>  @blanket_1.id ,
      :description     => "Awesome description"
    )
    
    @bwo = BarringWorkOrder.create_object(
      :work_order_date          =>  DateTime.now + 2.days, 
      :description              =>    "awesome recovery proces", 
      :warehouse_id =>   @warehouse.id 
    )
    
    
    @bwo_detail_1_code = "KFC"
    @bwo_detail_2_code = "KFC2"
    
    @bwo_detail_1 = BarringWorkOrderDetail.create_object(
      :barring_work_order_id => @bwo.id  , 
      :barring_id            => @barring_1.id   , 
      :code                  => @bwo_detail_1_code
    )
    
    @bwo_detail_2 = BarringWorkOrderDetail.create_object(
      :barring_work_order_id => @bwo.id  , 
      :barring_id            => @barring_1.id   , 
      :code                  => @bwo_detail_2_code
    )

    @bar_1.reload
    @bar_2.reload
    @blanket_1.reload
    
    @bar_1_wh_item.reload 
    @bar_2_wh_item.reload 
    @blanket_1_wh_item.reload 
    
    @target_item_1 = @bwo_detail_1.barring.item 
      
    @bwo.confirm_object(:confirmed_at => DateTime.now + 7.days)
    @bwo_detail_1.reload
    @bwo.reload 
  end
  
  it "should create stock adjustment for blanket " do
    @blanket_1.ready.should_not ==0  
  end
  
  it "should create stock adjustment for bar 1 " do 
    @bar_1.ready.should_not ==0  
  end
  
  it "should create stock adjustment for bar2  " do 
    @bar_2.ready.should_not == 0
  end
  
  it "should confirm bwo" do
    @bwo.is_confirmed.should be_true 
  end
  
  it "should be allowed to finish bwo_detail" do
    @bwo_detail_1.finish_object(
      :finished_at => DateTime.now ,
      :blanket_usage => 10
    )
    
    @bwo_detail_1.errors.messages.each {|x| puts "Super errror: #{x}"}
    @bwo_detail_1.is_finished.should be_true 
  end
  # 
  # context "finished bwo_detail" do
  #   before(:each) do
  #     @bwo_detail_1.finish_object(
  #       :finished_at => DateTime.now ,
  #       :blanket_usage => 10
  #     )
  #     
  #     @bar_1.reload
  #     @bar_2.reload
  #     @blanket_1.reload
  #     @barring_1.reload 
  #   end
  #   
  #   it "should finish bwo_1" do
  #     @bwo_detail_1.is_finished.should be_true 
  #   end
  #       # 
  #       # it "should create stock deduction for bar_1" do
  #       #   @bar_1.stock_mutations.where(
  #       #     :source_document_detail_id  =>  @bwo_detail_1.id ,  
  #       #     :source_document_detail     => @bwo_detail_1.class.to_s 
  #       #   ).count.should_not  ==  0 
  #       #   
  #       #   @bar_2.stock_mutations.where(
  #       #     :source_document_detail_id  =>  @bwo_detail_1.id ,  
  #       #     :source_document_detail     => @bwo_detail_1.class.to_s 
  #       #   ).count.should_not == 0 
  #       #   
  #       #   @blanket_1.stock_mutations.where(
  #       #     :source_document_detail_id  =>  @bwo_detail_1.id ,  
  #       #     :source_document_detail     => @bwo_detail_1.class.to_s 
  #       #   ).count.should_not == 0
  #       #   
  #       #   @barring_1.stock_mutations.where(
  #       #     :source_document_detail_id  =>  @bwo_detail_1.id ,  
  #       #     :source_document_detail     => @bwo_detail_1.class.to_s 
  #       #   ). count.should_not == 0 
  #       # end
  # end
  # 
  
  
end
