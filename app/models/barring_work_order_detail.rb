class BarringWorkOrderDetail < ActiveRecord::Base
  belongs_to :barring_work_order
  belongs_to :barring 
  
  validates_presence_of :barring_work_order_id, :barring_id , :code
  validates_uniqueness_of :code 
   
  validate :valid_barring_id
  validate :valid_barring_work_order_id
  
  def valid_barring_id
    return if not  barring_id.present? 
    
    object = Barring.find_by_id barring_id
    
    if object.nil?
      self.errros.add(:barring_id, "Harus ada")
      return self 
    end
    
  end
  
  def valid_barring_work_order_id
    return if not  barring_work_order_id.present? 
    
    object = BarringWorkOrder.find_by_id barring_work_order_id
    
    if object.nil?
      self.errros.add(:barring_work_order_id, "Harus ada")
      return self 
    end
    
  end


  def confirmed_at
    if self.is_rejected?
      return self.rejected_at
    elsif self.is_finished?
      return self.finished_at
    end
  end
   
  
  def self.create_object( params ) 
    
      
    
    new_object = self.new
    new_object.barring_work_order_id = params[:barring_work_order_id ]
    new_object.barring_id = params[:barring_id]
    new_object.code =  ( params[:code].present? ? params[:code   ].to_s.upcase : nil ) 
    
    
    new_object.save 
    
    return new_object
  end
  
  
  def update_object(params)
    
    if self.barring_work_order.is_confirmed?
      self.errors.add(:generic_errors, "Tidak bisa update")
      return self 
    end
     
    self.barring_id = params[:barring_id]
    self.code =  ( params[:code].present? ? params[:code   ].to_s.upcase : nil )
    self.save
    
    
    
  end
   
  
  
  
  def delete_object
    if not self.barring_work_order.is_confirmed?
      self.destroy 
    else
      self.errors.add(:generic_errors, "Sudah konfirmasi. Tidak bisa delete")
      return self 
    end
  end
  
  def blanket_warehouse_item
    WarehouseItem.find_or_create_object(
      :warehouse_id => self.barring_work_order.warehouse_id,
      :item_id => self.barring.blanket.item.id 
    )
  end
  
  
  def blanket
    self.barring.blanket 
  end
  
  def left_bar
    return nil if not  barring.is_bar_included? 
    
    Bar.find_by_id barring.left_bar_id 
  end
  
  def right_bar
    return nil if not  barring.is_bar_included? 
    
    Bar.find_by_id barring.right_bar_id
  end
  
  def left_bar_warehouse_item
    WarehouseItem.find_or_create_object(
      :warehouse_id => self.barring_work_order.warehouse_id,
      :item_id => left_bar.item .id 
    )
  end
  
  def right_bar_warehouse_item 
    WarehouseItem.find_or_create_object(
      :warehouse_id => self.barring_work_order.warehouse_id,
      :item_id => right_bar.item.id  
    )
  end
  
  def barring_warehouse_item
    WarehouseItem.find_or_create_object(
      :warehouse_id => self.barring_work_order.warehouse_id,
      :item_id => self.barring.item_id 
    )
  end
  
  
  # called upon finish 
  def non_negative_final_quantity_in_warehouse
    # will deduct the blanket
    
    puts "blanet ready: #{blanket_warehouse_item.ready }"
    puts "usage: #{self.blanket_usage}"
    if blanket_warehouse_item.ready  - self.blanket_usage < 0 
      self.errors.add(:generic_errors, "Total blanket akan menjadi negative")
      return self 
    end
    
    if left_bar_warehouse_item and right_bar_warehouse_item 
      if left_bar_warehouse_item == right_bar_warehouse_item
        if left_bar_warehouse_item and left_bar_warehouse_item.ready - 2 < 0 
          self.errors.add(:generic_errors, "Tidak cukup bar #{left_bar_warehouse_item.sku} akan menjadi negative")
          return self 
        end
      else
        if left_bar_warehouse_item and left_bar_warehouse_item.ready - 1 < 0 
          self.errors.add(:generic_errors, "Tidak cukup bar #{left_bar_warehouse_item.sku} akan menjadi negative")
          return self 
        end
        
        if right_bar_warehouse_item and right_bar_warehouse_item.ready - 1 < 0 
          self.errors.add(:generic_errors, "Tidak cukup bar #{left_bar_warehouse_item.sku} akan menjadi negative")
          return self 
        end
      end
    end
  end
  
  def confirmable? 
    return false if self.barring_work_order.is_confirmed?
    
     
    # self.non_negative_final_quantity_in_warehouse
    # not needed on confirm. The stock mutation happens during finish
    
    return false if self.errors.size != 0  
    
    
    return true
  end
  
   
  
  def confirm_object(confirmation_datetime)
    return self if not self.confirmable?
     
 
    
     
  end
  
  def unconfirmable?
    return false if not self.barring_work_order.is_confirmed? 
    return false if self.is_finished? 
    return false if self.is_rejected? 
     
    
    return true 
  end
  
  def unconfirm_object
    return self if not self.unconfirmable? 
  end
  
  def self.active_objects
    return self 
  end
  
  def finish_object( params ) 
    if not self.barring_work_order.is_confirmed?
      self.errors.add(:generic_errors, "Work Order belum konfirmasi")
      return self 
    end
    
    if self.is_finished?
      self.errors.add(:generic_errors, "Sudah selesai")
      return self 
    end
    
    if self.is_rejected? 
      self.errors.add(:generic_errros, "Sudah reject")
      return self 
    end
    
    if not params[:blanket_usage].present? 
      self.errors.add(:blanket_usage, "Harus ada pemakaian blanket")
      return self 
    end
    
    if params[:blanket_usage].present? and params[:blanket_usage].to_i <= 0 
      self.errors.add(:blanket_usage, "Pemakaian blanket harus lebih besar dari 0")
      return self 
    end
    
    self.blanket_usage = params[:blanket_usage]
    
    non_negative_final_quantity_in_warehouse
    return self if self.errors.size != 0 
    
 
    # stock mutation for blanket
    
    stock_mutation = StockMutation.create_bulk_usage_object( 
      blanket.item , # the item 
      self.blanket_usage, 
      self, # source_document_detail 
      STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
      STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
      barring_work_order.warehouse_id 
    )
    
    stock_mutation.item.update_stock_mutation( stock_mutation )  
    stock_mutation.warehouse_item.update_stock_mutation(stock_mutation)
    
    
    # stock mutation for right bar
    # stock mutation for left bar 
    
    if barring.is_bar_included?
      
      stock_mutation = StockMutation.create_bulk_usage_object( 
        left_bar.item , # the item 
        1,
        self, # source_document_detail 
        STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
        STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
        barring_work_order.warehouse_id 
      )

      stock_mutation.item.update_stock_mutation( stock_mutation )  
      stock_mutation.warehouse_item.update_stock_mutation(stock_mutation)
      
      
      stock_mutation = StockMutation.create_bulk_usage_object( 
        right_bar.item , # the item 
        1,
        self, # source_document_detail 
        STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
        STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
        barring_work_order.warehouse_id 
      )

      stock_mutation.item.update_stock_mutation( stock_mutation )  
      stock_mutation.warehouse_item.update_stock_mutation(stock_mutation)
      
    end
    
    stock_mutation = StockMutation.create_bulk_usage_object( 
      barring.item  , # the item 
      1,
      self, # source_document_detail 
      STOCK_MUTATION_CASE[:addition], # stock_mutation_case,
      STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
      barring_work_order.warehouse_id 
    )

    stock_mutation.item.update_stock_mutation( stock_mutation )  
    stock_mutation.warehouse_item.update_stock_mutation(stock_mutation)
    
     
    self.is_finished = true 
    self.finished_at = params[:finished_at]
    self.save
      
    
  end
  
  
  def unfinish_object 
    
    
    if not self.is_finished?
      self.errors.add(:generic_errors, "Belum ada penyelesaian")
      return self 
    end
    
    if self.roller_identification_detail.is_delivered?
      self.errors.add(:generic_errors, "Sudah ada pengiriman")
    end
    
    # if it is delivered, can't be unfinished 
     
    if self.barring_warehouse_item.ready - 1 < 0 
      self.errors.add(:generic_errors, "Tidak bisa cancel reject. Kuantitas #{self.barring_warehouse_item.sku} akan menjadi negative.")
    end
    
 
    StockMutation.get_by_source_document_detail( self, STOCK_MUTATION_ITEM_CASE[:ready] ).each do |sm|
      sm.item.reverse_stock_mutation( sm )
      sm.warehouse_item.reverse_stock_mutation( sm )
      sm.destroy
    end
    
    
   
    self.is_finished = false  
    self.finished_at =  nil 
    self.save
      
    
  end
  
  
  def reject_object( params )
    if self.is_rejected? 
      self.errors.add(:generic_errors, "Sudah reject")
      return self 
    end
    
    if self.is_finished?
      self.errors.add(:generic_errors, "Sudah finish")
      return self 
    end
    
    if not self.barring_work_order.is_confirmed?
      self.errors.add(:generic_errors, "belum konfirmasi")
      return self 
    end
    
    if not params[:rejected_at].present?
      self.errors.add(:rejected_at, "Harus ada tanggal reject")
      return self
    end

    if not params[:blanket_usage].present?
      self.errors.add(:blanket_usage, "Harus ada pemakaian blanket")
      return self 
    end

    if params[:blanket_usage].present? and params[:blanket_usage].to_i <= 0 
      self.errors.add(:blanket_usage, "Pemakaian blanket harus lebih besar dari 0")
      return self 
    end

    self.blanket_usage = params[:blanket_usage]

    
    non_negative_final_quantity_in_warehouse
    
    return self if self.errors.size !=  0 
    
    stock_mutation = StockMutation.create_bulk_usage_object( 
      blanket.item , # the item 
      blanket_usage, 
      self, # source_document_detail 
      STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
      STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
      barring_work_order.warehouse_id 
    )
    
    stock_mutation.item.update_stock_mutation( stock_mutation )  
    stock_mutation.warehouse_item.update_stock_mutation(stock_mutation)
    
    
    # stock mutation for right bar
    # stock mutation for left bar 
    
    if barring.is_bar_included?
      
      stock_mutation = StockMutation.create_bulk_usage_object( 
        left_bar.item , # the item 
        1,
        self, # source_document_detail 
        STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
        STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
        barring_work_order.warehouse_id 
      )

      stock_mutation.item.update_stock_mutation( stock_mutation )  
      stock_mutation.warehouse_item.update_stock_mutation(stock_mutation)
      
      
      stock_mutation = StockMutation.create_bulk_usage_object( 
        right_bar.item , # the item 
        1,
        self, # source_document_detail 
        STOCK_MUTATION_CASE[:deduction], # stock_mutation_case,
        STOCK_MUTATION_ITEM_CASE[:ready]  , # stock_mutation_item_case
        barring_work_order.warehouse_id 
      )

      stock_mutation.item.update_stock_mutation( stock_mutation )  
      stock_mutation.warehouse_item.update_stock_mutation(stock_mutation)
      
    end
    
    
    self.is_rejected = true 
    self.rejected_at = params[:rejected_at]
    self.save 
    
    
  end
  
  def unreject_object
    if not self.is_rejected? 
      self.errors.add(:generic_errors, "Belum reject")
      return self 
    end
    
    if self.is_finished?
      self.errors.add(:generic_errors, "Sudah finish")
      return self 
    end
    
    if not  self.roller_work_order.is_confirmed?
      self.errors.add(:generic_errors, "belum konfirmasi")
      return self 
    end
    
    if self.roller_identification_detail.is_job_scheduled?
      self.errors.add(:generic_errors, "Sudah ada work order lain untuk roller ini")
      return self 
    end
    
    if not params[:rejected_at].present?
      self.errors.add(:rejected_at, "Harus ada tanggal reject")
      return self
    end
    
    
    if self.barring_warehouse_item.ready - 1 < 0 
      self.errors.add(:generic_errors, "Tidak bisa cancel reject. Kuantitas #{self.barring_warehouse_item.sku} akan menjadi negative.")
    end
    
    StockMutation.get_by_source_document_detail( self, STOCK_MUTATION_ITEM_CASE[:ready] ).each do |sm|
      sm.item.reverse_stock_mutation( sm )
      sm.warehouse_item.reverse_stock_mutation( sm )
      sm.destroy
    end
    
    
    
    self.is_rejected = false 
    self.rejected_at =  nil 
    self.save  
  end
  
   
end
