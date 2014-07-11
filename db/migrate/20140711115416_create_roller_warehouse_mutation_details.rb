class CreateRollerWarehouseMutationDetails < ActiveRecord::Migration
  def change
    create_table :roller_warehouse_mutation_details do |t|
      
      t.integer :roller_warehouse_mutation_id 
      t.integer :roller_identification_detail_id   
      
      

      t.timestamps
    end
  end
end
