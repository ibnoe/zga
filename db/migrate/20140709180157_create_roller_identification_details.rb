class CreateRollerIdentificationDetails < ActiveRecord::Migration
  def change
    create_table :roller_identification_details do |t|
      t.integer :roller_identification_id 
      t.string :code 
      
      # select the inspected core
      t.integer :core_builder_id 
      
      t.boolean :is_new_core, :default => false 
      
      t.text :description # all other information regarding the identified : size, etc, compound 
      
      t.boolean :is_finished, :default => false  # if finished, the given identified core has been morphed into further item 
      t.boolean :is_canceled, :default => false  # if there is production reject. cancel? If canceled, can be performed on warehouse mutation 
      
      

      t.timestamps
    end
  end
end
