class CreateCoreBuilders < ActiveRecord::Migration
  def change
    create_table :core_builders do |t|
      
      t.string :used_core_sku
      t.integer :used_core_id 
      
      t.string :new_core_sku 
      t.integer :new_core_id 
      
      # used to select core receival for recovery 
      t.string :base_core_sku  
      
      
      t.text :description

      t.timestamps
    end
  end
end
