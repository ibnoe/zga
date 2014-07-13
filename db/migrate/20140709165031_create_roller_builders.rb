class CreateRollerBuilders < ActiveRecord::Migration
  def change
    create_table :roller_builders do |t|
      
      # automatically create 2 roller 
      # when work order is created, will select the base_roller_sku 
      t.string :roller_used_core_sku
      t.integer :roller_used_core_id
      
      t.string :roller_new_core_sku 
      t.integer :roller_new_core_id 
      
      t.string :base_roller_sku 
      
      t.integer :core_builder_id 
      
      t.integer :compound_id 
      
      t.text :description 
      t.timestamps
    end
  end
end
