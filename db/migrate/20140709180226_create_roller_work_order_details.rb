class CreateRollerWorkOrderDetails < ActiveRecord::Migration
  def change
    create_table :roller_work_order_details do |t|
      t.integer :roller_work_order_id 
      
      t.integer :roller_identification_detail_id 
      t.integer :roller_builder_id 
      t.string :code 
      
      t.datetime :finished_at
      t.boolean :is_finished , :default => false 
      
      t.boolean :is_rejected, :default => false 
      t.datetime :rejected_at 
      t.text :reject_description 
      

      t.timestamps
    end
  end
end
