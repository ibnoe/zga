class CreateComponents < ActiveRecord::Migration
  def change
    create_table :components do |t|
      t.integer :machine_id 
      t.string :name
      t.text :description 

      t.timestamps
    end
  end
end
