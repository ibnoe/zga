require 'spec_helper'

describe RollerWarehouseMutation do
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
    
    @rwo.confirm_object(
      :confirmed_at => DateTime.now 
    )
    @rwo_detail.reload
    @rwo_detail_2.reload 
  end
  
  it "should confirm rwo" do
    @rwo.is_confirmed.should be_true 
  end
   
  
  it "should create valid roller identification" do
    @rwm = RollerWarehouseMutation.create_object(
      :warehouse_mutation_date  => DateTime.now + 2.months   ,
      :description              => "awesome mutation"         ,
      :roller_identification_id => @ri.id  ,
      :target_warehouse_id      => @warehouse_2.id 

    )
    
    @rwm.should be_valid 
  end
  
   
  it "should require work_order_date and roller_identification_id" do
    @rwm = RollerWarehouseMutation.create_object(
      :warehouse_mutation_date  => nil  ,
      :description              => "awesome mutation"         ,
      :roller_identification_id => @ri.id  ,
      :target_warehouse_id      => @warehouse_2.id
    )
    
    @rwm.should_not be_valid 
    
    @rwm = RollerWarehouseMutation.create_object(
      :warehouse_mutation_date  => DateTime.now + 2.months   ,
      :description              => "awesome mutation"         ,
      :roller_identification_id => @ri.id  ,
      :target_warehouse_id      => nil 
    )
      
    @rwm.should_not  be_valid
    
    @rwm = RollerWarehouseMutation.create_object(
      :warehouse_mutation_date  => DateTime.now + 2.months   ,
      :description              => "awesome mutation"         ,
      :roller_identification_id => nil  ,
      :target_warehouse_id      => @warehouse_2.id  
    )
    @rwm.should_not  be_valid
  end
  
  context "created roller  warehouse mutation => update" do
    before(:each) do
      @rwm = RollerWarehouseMutation.create_object(
        :warehouse_mutation_date  => DateTime.now + 2.months   ,
        :description              => "awesome mutation"         ,
        :roller_identification_id => @ri.id  ,
        :target_warehouse_id      => @warehouse_2.id 

      )
    end
    
    it "should  be updatable" do
      @rwm.update_object(
        :warehouse_mutation_date  => DateTime.now + 2.months  + 1.days  ,
        :description              => "awesome mutation haha"         ,
        :roller_identification_id => @ri.id  ,
        :target_warehouse_id      => @warehouse_2.id
      )
      
      @rwm.errors.size.should == 0 
    end
    
    it "should be deletable" do
      @rwm.delete_object
      @rwm.persisted?.should be_true
      @rwm.is_deleted.should be_true 
    end
    
    
  end
  
  
  
  
   
  
  
end
