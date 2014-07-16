class CreateBarrings < ActiveRecord::Migration
  def change
    create_table :barrings do |t|
      t.string :barring_sku  
      t.boolean :is_bar_included, :default => false  
      t.integer :left_bar_id
      t.integer :right_bar_id 
      t.integer :blanket_id 
      t.string :description 
       
     
      
      t.timestamps
    end
  end
end
