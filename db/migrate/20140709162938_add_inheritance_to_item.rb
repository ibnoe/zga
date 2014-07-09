class AddInheritanceToItem < ActiveRecord::Migration
  def change
    # t.integer :producible_id
    #   t.string  :producible_type
    #   
    add_column :items,  :itemable_id, :integer
    add_column :items,  :itemable_type, :string
  end
end
