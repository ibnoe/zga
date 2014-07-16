class CreateBarringWorkOrderDetails < ActiveRecord::Migration
  def change
    create_table :barring_work_order_details do |t|
      t.integer :barring_work_order_id 
      t.integer :barring_id 
      t.string :code 
      
      t.boolean :is_finished, :default => false
      t.datetime :finished_at 
      t.string :finish_description
      
      t.boolean :is_rejected, :default => false
      t.datetime :rejected_at 
      t.string :reject_description 
      
      t.integer :blanket_usage, :default => 0 
      
      

      t.timestamps
    end
  end
end
