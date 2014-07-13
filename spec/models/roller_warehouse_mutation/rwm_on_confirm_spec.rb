require 'spec_helper'

describe RollerWarehouseMutationDetail do
  before(:each) do
    ItemType.setup_item_type
    @warehouse = Warehouse.create_object(
      :name => "warehouse awesome",
      :description => "Badaboom"
    )
    
    @warehouse_2 = Warehouse.create_object(
      :name => "warehouse second",
      :description => "Badaboom"
    )
    
    @target_warehouse = @warehouse_2
    
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
    @ri_detail_3 = RollerIdentificationDetail.create_object(
      :roller_identification_id => @ri.id , 
      :core_builder_id          =>  @core_builder_2.id, 
      :is_new_core              =>  false, 
      :identification_code      =>  "2014/1/1/1/C", 
      :description              =>  " awesome yoshinoya hahaha"
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
    
    @rwo_detail_2 = RollerWorkOrderDetail.create_object(
      :roller_work_order_id            => @rwo.id , 
      :roller_builder_id               => @roller_builder_2.id  , 
      :roller_identification_detail_id => @ri_detail_2.id 

    )
    
    @rwo_detail_3 = RollerWorkOrderDetail.create_object(
      :roller_work_order_id            => @rwo.id , 
      :roller_builder_id               => @roller_builder_2.id  , 
      :roller_identification_detail_id => @ri_detail_3.id 

    )
    
    @rwo.confirm_object(
      :confirmed_at => DateTime.now 
    )
    @rwo_detail.reload
    @rwo_detail_2.reload 
    @rwo_detail_3.reload 
    
    @rwo_detail.finish_object(
      :finished_at => DateTime.now + 4.months 
    )
    
    @rwo_detail_2.finish_object(
      :finished_at => DateTime.now + 4.months 
    )
    
    @rwo_detail_3.finish_object(
      :finished_at => DateTime.now + 4.months 
    )
    
    @rwm = RollerWarehouseMutation.create_object(
      :warehouse_mutation_date  => DateTime.now + 2.months   ,
      :description              => "awesome mutation"         ,
      :roller_identification_id => @ri.id  ,
      :target_warehouse_id      => @warehouse_2.id 
    )
    
    @rwm_detail = RollerWarehouseMutationDetail.create_object(
      :roller_warehouse_mutation_id     => @rwm.id ,
      :roller_identification_detail_id  => @rwo_detail.roller_identification_detail_id 
    )
    
    
    
    @rwm_detail_3  = RollerWarehouseMutationDetail.create_object(
      :roller_warehouse_mutation_id     => @rwm.id ,
      :roller_identification_detail_id  => @rwo_detail_3.roller_identification_detail_id
    )
  end
  
  
   
  
  it "should allow confirmation for roller work order" do
    @rwm.confirm_object(:confirmed_at => DateTime.now + 7.days)
    @rwm.errors.messages.each {|x| puts "rwm error: #{x}"}
    @rwm.errors.size.should == 0 
    @rwm.should be_valid 
  end
  
  it "should have 1 target item in warehouse 1" do
    @target_item_1 = @rwo_detail.target_item
    
    @source_warehouse_item_1 = WarehouseItem.find_or_create_object(
    :warehouse_id => @warehouse.id,
    :item_id => @target_item_1.id 
    )
    
    @target_warehouse_item_1 = WarehouseItem.find_or_create_object(
    :warehouse_id => @target_warehouse.id,
    :item_id => @target_item_1.id 
    )
    
    
    @source_warehouse_item_1.ready.should == 1 
    @target_warehouse_item_1.ready.should == 0 
  end

  
  context "confirming rwm" do
    before(:each) do
      @target_item_1 = @rwo_detail.target_item
  
      @target_item_3 = @rwo_detail_3.target_item
  
  
    
      @source_warehouse_item_1 = WarehouseItem.find_or_create_object(
      :warehouse_id => @warehouse.id,
      :item_id => @target_item_1.id 
      )
      
      @target_warehouse_item_1 = WarehouseItem.find_or_create_object(
      :warehouse_id => @target_warehouse.id,
      :item_id => @target_item_1.id 
      )
      
      
  
      @initial_ready_source_warehouse_item_1 = @source_warehouse_item_1.ready
      @initial_ready_target_warehouse_item_1 = @target_warehouse_item_1.ready
  
      @rwm.confirm_object(:confirmed_at => DateTime.now + 7.days)
      @rwm_detail.reload
      @rwm.reload 
      @ri_detail.reload
      @rwo_detail.reload 
      @source_warehouse_item_1.reload
      @target_warehouse_item_1.reload
  
    end
  
  
    it "should confirm rwo" do
      @rwm.is_confirmed.should be_true 
      @ri_detail.is_delivered.should be_true
    end
    
    it "should decrease target_item_1 and decrease source_item_1" do
      
      # on confirm, no stock mutation. on detail finished = stock mutation is created 
      
      StockMutation.where(
        :item_id => @target_item_1.id, 
        :source_document_detail => @rwm_detail.class.to_s,
        :source_document_detail_id => @rwm_detail.id ,
        :warehouse_id => @warehouse.id 
      ).count.should == 1

      @final_ready_source_warehouse_item_1 = @source_warehouse_item_1.ready
      diff_ready_source_warehouse_item_1 = @final_ready_source_warehouse_item_1 - @initial_ready_source_warehouse_item_1
      diff_ready_source_warehouse_item_1.should == -1 

      @final_ready_target_warehouse_item_1 = @target_warehouse_item_1.ready
      diff_ready_target_warehouse_item_1 = @final_ready_target_warehouse_item_1 - @initial_ready_target_warehouse_item_1
      diff_ready_target_warehouse_item_1.should == 1 
    end
    
    it "should not be updatable" do
      @rwm_detail.update_object(
        :roller_warehouse_mutation_id => @rwm.id,
        :roller_identification_detail_id => @rwo_detail_2.roller_identification_detail_id 
      )
      
      @rwm_detail.errors.size.should_not == 0 
    end
    
    it "should not be allowed to create new rwm_detail" do
      @rwm_detail_2  = RollerWarehouseMutationDetail.create_object(
           :roller_warehouse_mutation_id => @rwm.id,
           :roller_identification_detail_id => @rwo_detail_2.roller_identification_detail_id 
         )
      
      @rwm_detail_2.errors.size.should_not == 0 
    end
    
    it "should not be allowed to delete object" do
      @rwm_detail.delete_object
      @rwm_detail.persisted?.should be_true
      @rwm_detail.errors.size.should_not == 0 
    end
    
    it "should update the is_Delivered status in roller identification detail" do
      @ri_detail.reload
      @ri_detail_3.reload
      @ri_detail.is_delivered.should be_true
      @ri_detail_3.is_delivered.should be_true 
    end
    
    it "should be allowed to unconfirm" do
      @rwm.reload
      @rwm.unconfirm_object
      @rwm.is_confirmed.should be_false
      @rwm.errors.size.should == 0 
    end
    
    
    
    context "unconfirm" do
      before(:each) do
        @rwm.reload
        @rwm.unconfirm_object
        
        @ri_detail.reload
        @ri_detail_3.reload
      end
      
      
      it "should update the is_job_scheduled status" do
        @ri_detail.is_delivered.should be_false
        @ri_detail_3.is_delivered.should be_false
      end
    end
  end
  
  
    
  
  
   
  
  
end
