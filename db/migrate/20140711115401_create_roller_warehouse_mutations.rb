class CreateRollerWarehouseMutations < ActiveRecord::Migration
  def change
    create_table :roller_warehouse_mutations do |t|
      t.string :code 
      t.integer :roller_identification_id 
      
      t.date :warehouse_mutation_date 
      
      t.text :description 
      
      t.boolean :is_confirmed, :default => false
      t.datetime :confirmed_at 
      
      t.boolean :is_deleted, :default => false

      t.timestamps
    end
  end
end
