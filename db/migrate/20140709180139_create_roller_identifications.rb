class CreateRollerIdentifications < ActiveRecord::Migration
  def change
    create_table :roller_identifications do |t|
      
      # if the office is doing its own production, no customer receival 
      t.string :code 
      t.boolean :is_self_production, :default => false 
      
      t.integer :contact_id
      t.integer :warehouse_id 
      t.datetime :identification_date 
      
      t.text :description 
      
      t.boolean :is_confirmed, :default => false
      t.datetime :confirmed_at 
      
      t.boolean :is_deleted, :default => false 

      t.timestamps
    end
  end
end
