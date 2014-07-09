class CreateRollerWorkOrders < ActiveRecord::Migration
  def change
    create_table :roller_work_orders do |t|

      t.timestamps
    end
  end
end
