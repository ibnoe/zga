class CreateRollerIdentificationDetails < ActiveRecord::Migration
  def change
    create_table :roller_identification_details do |t|
      
      
      t.string :identification_code  # user write this on their own 
      
      t.integer :roller_identification_id 
      
      
      # select the inspected core
      t.integer :core_builder_id 
      
      t.boolean :is_new_core, :default => false 
      
      t.text :description # all other information regarding the identified : size, etc, compound 
      
      t.boolean :is_job_scheduled, :default => false 
      
      t.boolean :is_finished, :default => false  # if finished, the given identified core has been morphed into further item 
      t.boolean :is_delivered, :default => false  # if delivered, it will reduce the identified item in the warehouse  
        
      

      t.timestamps
    end
  end
end
