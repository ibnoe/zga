require 'spec_helper'

describe RollerIdentification do
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
    
  end
  
  it "should create roller builder" do
    @roller_builder_1.should be_valid
    @roller_builder_1.errors.size.should == 0 
    
    @roller_builder_2.should be_valid
    @roller_builder_2.errors.size.should == 0
  end
  
  it "should create valid roller identification" do
    @ri = RollerIdentification.create_object(
      :identification_date => DateTime.now  , 
      :description         => "awesome"          ,
      :warehouse_id        => @warehouse.id         ,
      :contact_id          => @contact.id           ,
      :is_self_production  => false   ,
      :description         => "awesome"
    )
    
    @ri.should be_valid 
  end
  
  it "should not require contact_id if it is for self production" do
    @ri = RollerIdentification.create_object(
      :identification_date => DateTime.now  , 
      :description         => "awesome"          ,
      :warehouse_id        => @warehouse.id         ,
      :contact_id          =>  nil          ,
      :is_self_production  => true   ,
      :description         => "awesome"
    )
    
    @ri.should be_valid 
  end
  
  it "should require identification_date and contact" do
    @ri = RollerIdentification.create_object(
      :identification_date => nil  , 
      :description         => "awesome"          ,
      :warehouse_id        => @warehouse.id         ,
      :contact_id          => @contact.id           ,
      :is_self_production  => false   ,
      :description         => "awesome"
    )
    
    @ri.should_not be_valid 
    
    @ri = RollerIdentification.create_object(
      :identification_date => DateTime.now  , 
      :description         => "awesome"          ,
      :warehouse_id        => @warehouse.id         ,
      :contact_id          =>  nil          ,
      :is_self_production  => false   ,
      :description         => "awesome" 
    )
     
    @ri.errors.messages.each {|x| puts " err in ri: #{x}"}
    @ri.should be_valid
  end
  
  context "created roller identification => update" do
    before(:each) do
      @ri = RollerIdentification.create_object(
        :identification_date => DateTime.now  , 
        :description         => "awesome"          ,
        :warehouse_id        => @warehouse.id         ,
        :contact_id          => @contact.id           ,
        :is_self_production  => false   ,
        :description         => "awesome"
      )
    end
    
    it "should  be updatable" do
      @ri.update_object(
        :identification_date => DateTime.now  , 
        :description         => "awesome bombastic"          ,
        :warehouse_id        => @warehouse.id         ,
        :contact_id          => @contact.id           ,
        :is_self_production  => false   ,
        :description         => "awesome"
      )
      
      @ri.errors.size.should == 0 
    end
    
    it "should be deletable" do
      @ri.delete_object
      @ri.persisted?.should be_true
      @ri.is_deleted.should be_true 
    end
    
    
  end
end
