class CreateItemTypes < ActiveRecord::Migration
  def change
    create_table :item_types do |t|
      
      t.string :name 
      t.text :description 
      t.boolean :is_deleted, :default  => false
      
      t.integer :is_legacy, :default => false 
      t.integer :legacy_code  

      t.timestamps
    end
  end
end
