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
    
    @ri.confirm_object(:confirmed_at => DateTime.now ) 
    @ri.reload 
    @warehouse_item_1.reload
    @warehouse_item_2.reload 
    @ri_detail.reload 
    @ri_detail_2.reload 
    @item_1.reload 
    @item_2.reload 
    
    @rwo = RollerWorkOrder.create_object(
      :work_order_date          =>  DateTime.now + 2.days, 
      :description              =>    "awesome recovery proces", 
      :roller_identification_id =>   @ri.id 
    )
    
    @rwo_detail = RollerWorkOrderDetail.create_object(
      :roller_work_order_id            => @rwo.id , 
      :roller_builder_id               => @roller_builder_1.id  , 
      :roller_identification_detail_id => @ri_detail.id 

    )
    
    @target_item_1 = @rwo_detail.target_item
    @source_item_1 = @rwo_detail.roller_identification_detail.item 
    
    
    @source_warehouse_item_1 = WarehouseItem.find_or_create_object(
      :warehouse_id => @warehouse.id,
      :item_id => @source_item_1.id 
    )
    
    @target_warehouse_item_1 = WarehouseItem.find_or_create_object(
      :warehouse_id => @warehouse.id,
      :item_id => @target_item_1.id 
    )
    
    @initial_ready_source_whi_1 = @source_warehouse_item_1.ready
    @initial_ready_target_whi_1 = @target_warehouse_item_1.ready
    
    @rwo.confirm_object(:confirmed_at => DateTime.now + 7.days)
    @rwo_detail.reload
    @rwo.reload 
    @ri_detail.reload
    @ri_detail_2.reload 
    @source_warehouse_item_1.reload
    @target_warehouse_item_1.reload
    

  end
  
  it "should have confirmed rwo" do
    @rwo.is_confirmed.should be_true 
  end
  
  it "should be allowed to finish rwo_detail" do
    @rwo_detail.reject_object(
      :rejected_at => DateTime.now + 1.months 
    )
     
    
    @rwo_detail.is_rejected.should be_true 
    @ri_detail.reload
    @ri_detail.is_job_scheduled.should be_false 
  end
  
  context "finishing rwo_detail" do
    before(:each) do
      
      @initial_ready_source_whi_1 = @source_warehouse_item_1.ready
      @initial_ready_target_whi_1 = @target_warehouse_item_1.ready
      
      @rwo_detail.reject_object(
        :rejected_at => DateTime.now + 1.months 
      )
      
      @source_warehouse_item_1.reload
      @target_warehouse_item_1.reload
      @rwo_detail.reload 
    end
    
    it "should not allow finish on rejected roller work order detail" do
      @rwo_detail.finish_object(
        :finished_at => DateTime.now + 10.days
      )
      
      @rwo_detail.errors.size.should_not == 0 
    end
    
    it "should not create stock mutation: convert from the core to roller" do
      @rwo_detail.is_rejected.should be_true 
      @final_ready_source_whi_1 = @source_warehouse_item_1.ready
      diff_ready_source_whi_1 = @final_ready_source_whi_1 - @initial_ready_source_whi_1
      diff_ready_source_whi_1.should == 0 
      
      @final_ready_target_whi_1 = @target_warehouse_item_1.ready
      diff_ready_target_whi_1 = @final_ready_target_whi_1 - @initial_ready_target_whi_1
      diff_ready_target_whi_1.should == 0 
    end
    
    
    context "cancel reject rwo detail" do
      before(:each) do
        @initial_ready_source_whi_1 = @source_warehouse_item_1.ready
        @initial_ready_target_whi_1 = @target_warehouse_item_1.ready
        
        @rwo_detail.unreject_object
         
        @source_warehouse_item_1.reload
        @target_warehouse_item_1.reload
      end
      
      it "should cancel stock mutation" do
        @rwo_detail.is_rejected.should be_false 
        @final_ready_source_whi_1 = @source_warehouse_item_1.ready
        diff_ready_source_whi_1 = @final_ready_source_whi_1 - @initial_ready_source_whi_1
        diff_ready_source_whi_1.should == 0  
    
        @final_ready_target_whi_1 = @target_warehouse_item_1.ready
        diff_ready_target_whi_1 = @final_ready_target_whi_1 - @initial_ready_target_whi_1
        diff_ready_target_whi_1.should == 0 
      end
    end
    
  end
  
   
  
  
end
