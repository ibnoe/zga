require 'spec_helper'

describe Barring do
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
    @blanket  = Blanket.create_object(
      :blanket_sku => @blanket_sku 
    )
  end
  
  it "should create bar" do
    @bar_1.should be_valid
    @bar_2.should be_valid 
  end
  
  it "should not be allowed to do barring" do
    @barring = Barring.create_object(
      :barring_sku     => @barring_sku,
      :is_bar_included => true ,
      :left_bar_id     => @bar_1.id,
      :right_bar_id    => @bar_2.id ,
      :blanket_id      =>  @blanket.id , 
      :description     => "Awesome description"
    )
    
    @barring.should  be_valid 
  end
  
  it "should not be allowed to do barring if it is specified that bar is included while there is no bar assigned" do
    @barring = Barring.create_object(
      :barring_sku     => @barring_sku,
      :is_bar_included => false ,
      :left_bar_id     => nil,
      :right_bar_id    => nil ,
      :blanket_id      =>  @blanket.id , 
      :description     => "Awesome description"
    )
    
    @barring.should_not   be_valid 
  end
  
     
  
  context "created barring" do
    before(:each) do
      @barring = Barring.create_object(
        :barring_sku     => @barring_sku,
        :is_bar_included => true ,
        :left_bar_id     => @bar_1.id,
        :right_bar_id    => @bar_2.id ,
        :blanket_id      =>  @blanket.id , 
        :description     => "Awesome description"
      )
      
    end
     
    
    it "should not allow update to sku that has been existing" do
      @barring = Barring.create_object(
        :barring_sku     => @barring_sku,
        :is_bar_included => true ,
        :left_bar_id     => @bar_2.id,
        :right_bar_id    => @bar_2.id ,
        :blanket_id      =>  @blanket.id , 
        :description     => "Awesome description"
      )
      @barring.errors.size.should_not == 0
      
    end
    
    it "should allow update" do
      @barring.update_object(
        :barring_sku     => @barring_sku,
        :is_bar_included => true ,
        :left_bar_id     => @bar_1.id,
        :right_bar_id    => @bar_1.id ,
        :blanket_id      =>  @blanket.id , 
        :description     => "Awesome description"
      )
      
      @barring.should be_valid 
      
    end
    
    
  end


end
