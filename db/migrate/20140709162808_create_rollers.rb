class CreateRollers < ActiveRecord::Migration
  def change
    create_table :rollers do |t|
      t.string :roller_sku
      t.timestamps
    end
  end
end
