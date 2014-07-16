class CreateBlankets < ActiveRecord::Migration
  def change
    create_table :blankets do |t|
      t.string :blanket_sku

      t.timestamps
    end
  end
end
