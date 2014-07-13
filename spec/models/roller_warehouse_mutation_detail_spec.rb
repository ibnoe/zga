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
    
    @rwo_detail_3.finish_object(
      :finished_at => DateTime.now + 4.months 
    )
    
    @rwm = RollerWarehouseMutation.create_object(
      :warehouse_mutation_date  => DateTime.now + 2.months   ,
      :description              => "awesome mutation"         ,
      :roller_identification_id => @ri.id  ,
      :target_warehouse_id      => @warehouse_2.id 
    )
    
  end
  
  it "should finish rwo_detail and rwo_detail_3" do
    @rwo_detail_3.is_finished.should be_true 
    @rwo_detail.is_finished.should be_true 
  end
   
  
  it "should not allow detail creation if it is not finished" do
    @rwm_detail = RollerWarehouseMutationDetail.create_object(
      :roller_warehouse_mutation_id     => @rwm.id ,
      :roller_identification_detail_id  => @rwo_detail_2.roller_identification_detail_id 
    )
    
    @rwm_detail.should_not be_valid
  end
  
  it "should  allow detail creation if it is  finished" do
    @rwm_detail = RollerWarehouseMutationDetail.create_object(
      :roller_warehouse_mutation_id     => @rwm.id ,
      :roller_identification_detail_id  => @rwo_detail.roller_identification_detail_id 
    )
    
    @rwm_detail.should be_valid
  end
   
  context "created rwm_detail" do
    before(:each) do 
      @rwm_detail = RollerWarehouseMutationDetail.create_object(
        :roller_warehouse_mutation_id     => @rwm.id ,
        :roller_identification_detail_id  => @rwo_detail.roller_identification_detail_id 
      )
      
     
      
    end
     
    it "should create valid roller work order" do
      @rwm_detail.should be_valid 
      @rwm_detail.should be_valid 
    end
    
    
    it "should be updatable" do
      @rwm_detail.update_object(
        :roller_warehouse_mutation_id     => @rwm.id ,
        :roller_identification_detail_id  => @rwo_detail_3.roller_identification_detail_id
      )
      
      @rwm_detail.errors.messages.each {|x| puts "err: #{x}"}
      
      @rwm_detail.errors.size.should == 0
      @rwm_detail.should be_valid 
    end
    
    
    
    
   
    
    it "should be deletable" do
      @rwm_detail.delete_object
      @rwm_detail.persisted?.should be_false
    end
    
    
    
    context "created 2 roller work order detail" do
      before(:each) do
        @rwm_detail_3  = RollerWarehouseMutationDetail.create_object(
          :roller_warehouse_mutation_id     => @rwm.id ,
          :roller_identification_detail_id  => @rwo_detail_3.roller_identification_detail_id
        )
      end 
    
      it "should create rwm_detail 3 " do
        @rwm_detail_3.errors.messages.each {|x| puts "rwm_detail: #{x}"}
        @rwm_detail_3.errors.size.should == 0 
        @rwm_detail_3.should be_valid
      end
    
    
     
    
      it "should be unique" do
        @rwm_detail_3.update_object(
          :roller_warehouse_mutation_id     => @rwm.id ,
          :roller_identification_detail_id  => @rwo_detail.roller_identification_detail_id
        )
        @rwm_detail_3.errors.size.should_not == 0 
      end
    end
    
    
    
  
  
  end
  
  
   
  
  
end
