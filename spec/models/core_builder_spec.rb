require 'spec_helper'

describe CoreBuilder do
  before(:each) do
    ItemType.setup_item_type
    
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
  end
  
  it "should not be alloewd to create core builder if the sku has been existing" do
    @core_builder = CoreBuilder.create_object(
      :used_core_sku => @item_sku  ,          
      :new_core_sku  =>  "33214N",
      :base_core_sku => "33214",
      :description   =>  "Awesome core"
    )
    
    @core_builder.should_not be_valid 
  end
  
  
  it "should be allowed to create core builder" do
    @core_builder = CoreBuilder.create_object(
      :used_core_sku => "33214U"  ,          
      :new_core_sku  =>  "33214N",
      :base_core_sku => "33214",
      :description   =>  "Awesome core"
    )
    
    
    @core_builder.errors.messages.each {|x| puts "error message: #{x}"}
    
    
    @core_builder.errors.size.should == 0
    
    @core_builder.should be_valid 
  end
  
  it "should not allow empty used core sku" do
    @core_builder = CoreBuilder.create_object(
      :used_core_sku => ""  ,          
      :new_core_sku  =>  "33214N",
      :base_core_sku => "33214",
      :description   =>  "Awesome core"
    )
    
    @core_builder.should_not be_valid 
  end
  
  it "should allow concrete sku to have same value as abstract sku (base_core_sku)" do
    @core_builder = CoreBuilder.create_object(
      :used_core_sku => "33214U"  ,          
      :new_core_sku  =>  "33214N",
      :base_core_sku => "33214",
      :description   =>  "Awesome core"
    )
    
    @core_builder.errors.size.should == 0
    
    @core_builder.should be_valid
  end
  
  context "created core builder" do
    before(:each) do
      @core_builder = CoreBuilder.create_object(
        :used_core_sku => "33214U"  ,          
        :new_core_sku  =>  "33214N",
        :base_core_sku => "33214",
        :description   =>  "Awesome core"
      )
    end
    
    it "should create core" do
      used_core = Core.find_by_core_sku @core_builder.used_core_sku
      new_core = Core.find_by_core_sku @core_builder.new_core_sku 
      
      used_core.should be_valid
      new_core.should be_valid 
    end
    
    context "on core builder update, the core will update its sku as well" do
      before(:each) do
        
        @used_core = Core.find_by_core_sku @core_builder.used_core_sku
        @new_core = Core.find_by_core_sku @core_builder.new_core_sku
        
        @used_core_sku = "USED"
        @new_core_sku = "NEW"
        @core_builder.update_object(
          :used_core_sku => @used_core_sku  ,          
          :new_core_sku  =>  @new_core_sku,
          :base_core_sku => "33214",
          :description   =>  "Awesome core"
        )
        
        @new_core.reload 
        @used_core.reload
      end
      
      it "should update the core_sku in the previously linked core" do
        @new_core.core_sku.should == @new_core_sku
        @used_core.core_sku.should == @used_core_sku
        
        @new_core.item.sku.should == @new_core_sku
        @used_core.item.sku.should == @used_core_sku
      end
    end
  end
end
