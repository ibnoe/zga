class CreateRollerWorkOrders < ActiveRecord::Migration
  def change
    create_table :roller_work_orders do |t|

      t.string :code 
      t.integer :roller_identification_id 
      t.datetime :work_order_date 
      
      t.text :description 
      
      t.boolean :is_confirmed, :default => false
      t.datetime :confirmed_at 
      
      
      # auto deduce based on the roller_identification_id 
      t.integer :source_warehouse_id 
      t.integer :target_warehouse_id 
      
      t.timestamps
    end
  end
end
