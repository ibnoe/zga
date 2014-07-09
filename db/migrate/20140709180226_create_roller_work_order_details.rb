class CreateRollerWorkOrderDetails < ActiveRecord::Migration
  def change
    create_table :roller_work_order_details do |t|

      t.timestamps
    end
  end
end
