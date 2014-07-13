class CreateCompounds < ActiveRecord::Migration
  def change
    create_table :compounds do |t|
      t.string :compound_sku

      t.timestamps
    end
  end
end
