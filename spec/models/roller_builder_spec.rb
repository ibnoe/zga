require 'spec_helper'

describe RollerBuilder do
  before(:each) do
    ItemType.setup_item_type
    
    @item_sku = 'itemsku'
    
    @item_type = ItemType.create_object(
      :name => "Others",
      :description => "on off item"
    )
    
    @core_builder_base_sku = "332211"
    @core_builder_new_core_sku = "332211U"
    @core_builder_used_core_sku = "332211N"
    
    @item = Item.create_object(
    :sku            => @item_sku,
    :description    => "awesome description", 
    :standard_price => BigDecimal("150000"),
    :item_type_id => @item_type.id
    )
    
    @compound = Compound.create_object(
    :compound_sku            => "compo1",
    :description    => "awesome description" 
    )
    
    @core_builder = CoreBuilder.create_object(
      :used_core_sku => @core_builder_used_core_sku ,          
      :new_core_sku  =>  @core_builder_new_core_sku,
      :base_core_sku => @core_builder_base_sku,
      :description   =>  "Awesome core"
    )
    
    @roller_builder_base_sku = "R332211"
    @roller_builder_new_core_sku = "R332211U"
    @roller_builder_used_core_sku = "R332211N"
  end
  
  it "should create core_builder" do
    @core_builder.errors.size.should == 0 
    @core_builder.should be_valid 
  end
  
  it "should create compound" do
    @compound.should be_valid 
  end
  
  it "should not be alloewd to create core builder if the sku has been existing" do
    @roller_builder = RollerBuilder.create_object(
      :roller_used_core_sku => @item_sku     ,     
      :roller_new_core_sku  => @roller_builder_new_core_sku   ,
      :base_roller_sku      => @roller_builder_base_sku        ,
      :compound_id          => @compound.id           ,
      :description          => "awesome bla bla bla"          ,
      :core_builder_id      => @core_builder.id 
    )
    
    @roller_builder.should_not be_valid 
  end
  
  
  it "should be allowed to create core builder" do
    @roller_builder = RollerBuilder.create_object(
      :roller_used_core_sku => @roller_builder_used_core_sku     ,     
      :roller_new_core_sku  => @roller_builder_new_core_sku   ,
      :base_roller_sku      => @roller_builder_base_sku        ,
      :compound_id          => @compound.id           ,
      :description          => "awesome bla bla bla"          ,
      :core_builder_id      => @core_builder.id
    )
    
    
    @roller_builder.errors.messages.each {|x| puts "error message: #{x}"}
    
    
    @roller_builder.errors.size.should == 0
    
    @roller_builder.should be_valid 
  end
  
  
  
  it "should not allow empty used core sku" do
    @roller_builder = RollerBuilder.create_object(
      :roller_used_core_sku => ""    ,     
      :roller_new_core_sku  => @roller_builder_new_core_sku   ,
      :base_roller_sku      => @roller_builder_base_sku        ,
      :compound_id          => @compound.id           ,
      :description          => "awesome bla bla bla"          ,
      :core_builder_id      => @core_builder.id
    )
    
    @roller_builder.should_not be_valid 
  end
  
  
  context "created roller builder builder" do
    before(:each) do
      @roller_builder = RollerBuilder.create_object(
        :roller_used_core_sku => @roller_builder_used_core_sku     ,     
        :roller_new_core_sku  => @roller_builder_new_core_sku   ,
        :base_roller_sku      => @roller_builder_base_sku        ,
        :compound_id          => @compound.id           ,
        :description          => "awesome bla bla bla"          ,
        :core_builder_id      => @core_builder.id
      )
    end
    
    it "should create valid roller bulde" do
      @roller_builder.errors.messages.each {|x| puts "err-msg: #{x}"}
      @roller_builder.errors.size.should == 0 
      @roller_builder.should be_valid
    end
    
    it "should create roller" do
      used_core_roller = Roller.find_by_roller_sku @roller_builder.roller_used_core_sku
      new_core_roller = Roller.find_by_roller_sku @roller_builder.roller_new_core_sku 
      
      used_core_roller.should be_valid
      new_core_roller.should be_valid 
    end
    
    it "should not allow update to sku that has been existing" do
      @roller_builder.update_object(
        :roller_used_core_sku => @item_sku     ,     
        :roller_new_core_sku  => @roller_builder_new_core_sku   ,
        :base_roller_sku      => @roller_builder_base_sku        ,
        :compound_id          => @compound.id           ,
        :description          => "awesome bla bla bla"          ,
        :core_builder_id      => @core_builder.id
        
      )
      
      @roller_builder.errors.size.should_not == 0
      
    end
    
    it "should allow update" do
      @roller_builder.update_object(
        :roller_used_core_sku => @roller_builder_used_core_sku     ,     
        :roller_new_core_sku  => @roller_builder_new_core_sku   ,
        :base_roller_sku      => @roller_builder_base_sku        ,
        :compound_id          => @compound.id           ,
        :description          => "awesome bla bla eaijafj"          ,
        :core_builder_id      => @core_builder.id
      )
      
      @roller_builder.errors.size.should == 0
      
    end
    
    context "on core builder update, the core will update its sku as well" do
      before(:each) do
        
        @roller_used_core = Roller.find_by_roller_sku @roller_builder.roller_used_core_sku
        @roller_new_core = Roller.find_by_roller_sku @roller_builder.roller_new_core_sku
        
        @new_roller_used_core_sku = "USED"
        @new_roller_new_core_sku = "NEW"
        @roller_builder.update_object(
          
          :roller_used_core_sku => @new_roller_used_core_sku     ,     
          :roller_new_core_sku  => @new_roller_new_core_sku   ,
          :base_roller_sku      => @roller_builder_base_sku        ,
          :compound_id          => @compound.id           ,
          :description          => "awesome bla bla eaijafj"          ,
          :core_builder_id      => @core_builder.id
          
          
        )
        
        @roller_new_core.reload 
        @roller_used_core.reload
      end
      
      it "should update the roller_sku in the previously linked core" do
        @roller_new_core.roller_sku.should == @new_roller_new_core_sku
        @roller_used_core.roller_sku.should == @new_roller_used_core_sku
        
        @roller_new_core.item.sku.should == @new_roller_new_core_sku
        @roller_used_core.item.sku.should == @new_roller_used_core_sku
      end
    end
      
  
  end

end
