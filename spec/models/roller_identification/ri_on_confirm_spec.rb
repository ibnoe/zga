require 'spec_helper'

describe RollerIdentificationDetail do
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
    
    @item_sku = 'itemsku'
    
    @item_type = ItemType.create_object(
      :name => "Others",
      :description => "on off item"
    )
    
    @item = Item.create_object(
    :sku            => @item_sku,
    :description    => "awesome description", 
    :standard_price => BigDecimal("150000"),
    :item_type_id => @item_type.id
    )
    
    @core_builder_base_sku_1 = "332211"
    @core_builder_new_core_sku_1 = "332211U"
    @core_builder_used_core_sku_1 = "332211N"
    
    @compound_1 = Compound.create_object(
    :compound_sku            => "compo1",
    :description    => "awesome description" 
    )
    
    @core_builder_1 = CoreBuilder.create_object(
      :used_core_sku => @core_builder_used_core_sku_1 ,          
      :new_core_sku  =>  @core_builder_new_core_sku_1,
      :base_core_sku => @core_builder_base_sku_1,
      :description   =>  "Awesome core"
    )
    
    @roller_builder_base_sku_1 = "R332211"
    @roller_builder_new_core_sku_1 = "R332211U"
    @roller_builder_used_core_sku_1 = "R332211N"
    
    
    
    @roller_builder_1 = RollerBuilder.create_object(
      :roller_used_core_sku => @roller_builder_used_core_sku_1     ,     
      :roller_new_core_sku  => @roller_builder_new_core_sku_1   ,
      :base_roller_sku      => @roller_builder_base_sku_1       ,
      :compound_id          => @compound_1.id           ,
      :description          => "awesome bla bla bla"          ,
      :core_builder_id      => @core_builder_1.id
    )
    
    # roller builder 2 
    
    @core_builder_base_sku_2 =      "2_332211"
    @core_builder_new_core_sku_2 =  "2_332211U"
    @core_builder_used_core_sku_2 = "2_332211N"
    
    @compound_2 = Compound.create_object(
    :compound_sku            => "compo2",
    :description    => "awesome description" 
    )
    
    @core_builder_2 = CoreBuilder.create_object(
      :used_core_sku => @core_builder_used_core_sku_2 ,          
      :new_core_sku  =>  @core_builder_new_core_sku_2,
      :base_core_sku => @core_builder_base_sku_2,
      :description   =>  "Awesome core"
    )
    
    @roller_builder_base_sku_2 =      "2_R332211"
    @roller_builder_new_core_sku_2 =  "2_R332211U"
    @roller_builder_used_core_sku_2 = "2_R332211N"
    
    
    
    @roller_builder_2 = RollerBuilder.create_object(
      :roller_used_core_sku => @roller_builder_used_core_sku_2     ,     
      :roller_new_core_sku  => @roller_builder_new_core_sku_2   ,
      :base_roller_sku      => @roller_builder_base_sku_2       ,
      :compound_id          => @compound_2.id           ,
      :description          => "awesome bla bla bla"          ,
      :core_builder_id      => @core_builder_2.id
    )
    
    @ri = RollerIdentification.create_object(
      :identification_date => DateTime.now  , 
      :description         => "awesome"          ,
      :warehouse_id        => @warehouse.id         ,
      :contact_id          => @contact.id           ,
      :is_self_production  => false   ,
      :description         => "awesome"
    )
    
    @ri_detail = RollerIdentificationDetail.create_object(
      :roller_identification_id => @ri.id , 
      :core_builder_id          =>  @core_builder_1.id, 
      :is_new_core              =>  false, 
      :identification_code      =>  "2014/1/1/1/A", 
      :description              =>  " awesome yoshinoya"
    )
    
    @ri_detail_2 = RollerIdentificationDetail.create_object(
      :roller_identification_id => @ri.id , 
      :core_builder_id          =>  @core_builder_2.id, 
      :is_new_core              =>  false, 
      :identification_code      =>  "2014/1/1/1/B", 
      :description              =>  " awesome yoshinoya"
    )
    
    @ri.reload
    @ri_detail.reload
    @ri_detail_2.reload 
    
    @item_1 = @ri_detail.item
    @item_2 = @ri_detail_2.item 
    
    @warehouse_item_1 = WarehouseItem.find_or_create_object(
      :item_id        => @item_1.id , 
      :warehouse_id   => @warehouse.id 
    )
    
    @warehouse_item_2 = WarehouseItem.find_or_create_object(
      :item_id        => @item_2.id , 
      :warehouse_id   => @warehouse.id 
    )
  end
  
  it "should create valid ri_detail1 and ri_detail2" do
    @ri_detail.should be_valid 
    @ri_detail_2.should be_valid 
  end
  
  it "should create valid initial object" do
    puts "item_1 : #{@item_1}"
    puts "item_2 : #{@item_2}"
    puts "warehouse_item_1: #{@warehouse_item_1}"
    puts "warehouse_item_2: #{@warehouse_item_2}"
    
    @item_1.should be_valid
    @item_2.should be_valid
    
    @warehouse_item_1.should be_valid 
    @warehouse_item_2.should be_valid 
  end
  
  it "should allowed to confirm" do
    @ri.confirm_object( 
      :confirmed_at => DateTime.now + 2.days 
    )
    
    @ri.is_confirmed.should be_true
  end
  
  context "confirm roller identification" do
    before(:each) do
      
      
      @initial_ready_warehouse_item_1 = @warehouse_item_1.ready 
      @initial_ready_warehouse_item_2 = @warehouse_item_2.ready 
  
      @ri.confirm_object( 
        :confirmed_at => DateTime.now + 2.days 
      )
      
       
      @ri.reload 
      @warehouse_item_1.reload
      @warehouse_item_2.reload
      
    end

    it "should confirm ri" do
      @ri.is_confirmed.should be_true
    end
    
    it "should increase ready stock" do
      @final_ready_warehouse_item_1 = @warehouse_item_1.ready 
      diff = @initial_ready_warehouse_item_1 - @final_ready_warehouse_item_1
      diff.should == -1 
    
      @final_ready_warehouse_item_2 = @warehouse_item_2.ready 
      diff = @initial_ready_warehouse_item_2 - @final_ready_warehouse_item_2
      diff.should == -1
    end
    
    it "should not be updatable" do
      @ri_detail.update_object(
        :roller_identification_id => @ri.id , 
        :core_builder_id          =>  @core_builder_1.id, 
        :is_new_core              =>  false, 
        :identification_code      =>  "2014/1/1/1/C", 
        :description              =>  " awesome hahahaa"
      )
      
      @ri_detail.errors.size.should_not == 0 
    end
    
    it "should not be allowed to create new ri_detail" do
      @ri_detail_3 = RollerIdentificationDetail.create_object(
        :roller_identification_id => @ri.id , 
        :core_builder_id          =>  @core_builder_1.id, 
        :is_new_core              =>  false, 
        :identification_code      =>  "2014/1/1/1/C", 
        :description              =>  " awesome yoshinoya"
      )
      
      @ri_detail_3.errors.size.should_not == 0 
    end
    
    it "should not be allowed to delete object" do
      @ri_detail_2.delete_object
      @ri_detail_2.persisted?.should be_true
      @ri_detail_2.errors.size.should_not == 0 
    end
    
    it "should be allowed to unconfirm" do
      @ri.reload
      @ri.unconfirm_object
      @ri.is_confirmed.should be_false
      @ri.errors.size.should == 0 
    end
    
    context "unconfirm" do
      before(:each) do
        @warehouse_item_1.reload 
        @warehouse_item_2.reload 
        
        @initial_ready_warehouse_item_1 = @warehouse_item_1.ready 
        @initial_ready_warehouse_item_2 = @warehouse_item_2.ready
        
        
        @ri.unconfirm_object
        @ri.reload 
        
        @warehouse_item_1.reload 
        @warehouse_item_2.reload
        
      end
      
      it "should return  reverse the quantity of ready item" do
         
        @final_ready_warehouse_item_1 = @warehouse_item_1.ready
        diff = @initial_ready_warehouse_item_1 - @final_ready_warehouse_item_1
        
        diff.should == 1 
         
        @final_ready_warehouse_item_2 = @warehouse_item_2.ready
        diff = @initial_ready_warehouse_item_2 - @final_ready_warehouse_item_2
        
        diff.should == 1 
        
        StockMutation.count.should == 0 
      end
    end
  
    
    
  end
    
end
