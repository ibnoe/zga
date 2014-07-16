require 'spec_helper'

describe BarringWorkOrder do
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
    
    @barring_1 = Barring.create_object(
      :barring_sku     => @barring_sku,
      :is_bar_included => true ,
      :left_bar_id     => @bar_1.id,
      :right_bar_id    => @bar_2.id ,
      :blanket_id      =>  @blanket_1.id ,
      :description     => "Awesome description"
    )
    
    
  end
  
  it "should sane " do
    @barring_1.should be_valid
    @blanket_1.should be_valid
    @bar_1.should be_valid
    @bar_2.should be_valid 
  end
   
  
  it "should create valid roller identification" do
    @bwo = BarringWorkOrder.create_object(
      :work_order_date          =>  DateTime.now + 2.days, 
      :description              =>    "awesome recovery proces", 
      :warehouse_id =>   @warehouse.id 
    )
    
    @bwo.should be_valid 
  end
  
   
  it "should require work_order_date and warehouse_id" do
    @bwo = BarringWorkOrder.create_object(
      :work_order_date          =>  nil, 
      :description              =>    "awesome recovery proces", 
      :warehouse_id =>   @warehouse.id
    )
    
    @bwo.should_not be_valid 
    
    @bwo = BarringWorkOrder.create_object(
      :work_order_date          =>  DateTime.now + 2.days, 
      :description              =>    "awesome recovery proces", 
      :warehouse_id =>   nil 
    )
      
    @bwo.should_not  be_valid
  end
  
  context "created roller work order => update" do
    before(:each) do
      @bwo = BarringWorkOrder.create_object(
        :work_order_date          =>  DateTime.now + 2.days, 
        :description              =>    "awesome recovery proces", 
        :warehouse_id =>   @warehouse.id 
      )
    end
    
    it "should  be updatable" do
      @bwo.update_object(
        :work_order_date          =>  DateTime.now + 2.days + 3.days , 
        :description              =>    "awesome recovery proces ipdated", 
        :warehouse_id =>   @warehouse.id
      )
      
      @bwo.errors.size.should == 0 
    end
    
    it "should be deletable" do
      @bwo.delete_object
      @bwo.persisted?.should be_true
      @bwo.is_deleted.should be_true 
    end
    
    
  end
  
  
end
