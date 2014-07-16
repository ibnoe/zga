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
  end
  
  it "should be sane" do
    @bwo.should be_valid 
  end
  
  
  it "should allow barring  work order detail creation" do
   
    @bwo_detail = BarringWorkOrderDetail.create_object(
      :barring_work_order_id => @bwo.id  , 
      :barring_id            => @barring_1.id , 
      :code                  =>" AAE wfea"

  
    )
    
    @bwo_detail.should be_valid 
  end
  
  it "should not allow barring work order detail if no barring_id" do
    @bwo_detail = BarringWorkOrderDetail.create_object(
      :barring_work_order_id => @bwo.id  , 
      :barring_id            => nil  , 
      :code                  =>" AAE wfea"
    )
    
    @bwo_detail.errors.size.should_not == 0 
    
    @bwo_detail.should_not be_valid
  end
  
   
  
  context "created bwo_detail" do
    before(:each) do 
      @bwo_detail = BarringWorkOrderDetail.create_object(
        :barring_work_order_id => @bwo.id  , 
        :barring_id            => @barring_1.id , 
        :code                  =>"KFC"
      )
    end
     
    it "should create valid barring work order" do
      @bwo_detail.should be_valid 
    end
    
    
    it "should be updatable" do
      @bwo_detail_1_code = "KFC"
      @bwo_detail.update_object(
        :barring_work_order_id => @bwo.id  , 
        :barring_id            => @barring_2.id , 
        :code                  => @bwo_detail_1_code
      )
      
      @bwo_detail.errors.messages.each {|x| puts "err: #{x}"}
      
      @bwo_detail.errors.size.should == 0
      @bwo_detail.should be_valid 
    end
    
    
    
    
   
    
    it "should be deletable" do
      @bwo_detail.delete_object
      @bwo_detail.persisted?.should be_false
    end
    
    it "should have unique barring detail code  " do
      @bwo_detail_2 = BarringWorkOrderDetail.create_object(
        :barring_work_order_id => @bwo.id  , 
        :barring_id            => @barring_2.id , 
        :code                  =>"KFC"
      )
      
      @bwo_detail_2.errors.size.should_not == 0 
    end
  
      
     
     context "created 2 barring work order detail" do
       before(:each) do
         @bwo_detail_2  = BarringWorkOrderDetail.create_object(
           :barring_work_order_id => @bwo.id  , 
           :barring_id            => @barring_1.id , 
           :code                  =>"KFC33"
         )
       end 
     
       it "should create bwo_detail 2 " do
         @bwo_detail_2.errors.size.should == 0 
         @bwo_detail_2.should be_valid
       end
     
     
       
       
     end
     
    
    
  
  
  end
   
  
  
end
