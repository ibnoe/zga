class CreateBarringWorkOrders < ActiveRecord::Migration
  def change
    create_table :barring_work_orders do |t|
      t.string :code
      t.integer :warehouse_id 
      t.string :description 
      t.datetime :work_order_date
      
      t.boolean :is_deleted
      t.boolean :is_confirmed
      t.datetime :confirmed_at 

      t.timestamps
    end
  end
end
