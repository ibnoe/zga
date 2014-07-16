class CreateBars < ActiveRecord::Migration
  def change
    create_table :bars do |t|
      t.string :bar_sku 
      
      
      t.timestamps
    end
  end
end
