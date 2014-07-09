class CreateCores < ActiveRecord::Migration
  def change
    create_table :cores do |t|
      t.string :core_sku 
      t.timestamps
    end
  end
end
