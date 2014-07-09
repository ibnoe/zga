<?php

class purchase_invoice_get_fn extends Controller {

	function purchase_invoice_get_fn()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function get_by($field_to_get, $by_field, $by_id)
	{
		if ($field_to_get == "total")
		{
			$this->db->where("receiveditem_id", $by_id);
			$q = $this->db->get("receiveditemline");
			
			$total = 0;
			foreach ($q->result() as $row)
			{
				$total += $row->subtotal;
			}
            echo $total;
		}
	    else if ($field_to_get == "currencyrate")
		{
			$this->db->where("receiveditem_id", $by_id);
			$q = $this->db->get("receiveditemline");
			
			if ($q->num_rows())
			{
				$purchaseorderline_id = $q->row()->purchaseorderline_id;
				
				$this->db->where("id", $purchaseorderline_id);
				$q = $this->db->get("purchaseorderline");
				
				if ($q->num_rows())
				{
					$purchaseorder_id = $q->row()->purchaseorder_id;
					
					$this->db->where("id", $purchaseorder_id);
					$q = $this->db->get("purchaseorder");
					
					if ($q->num_rows())
					{
						$currency_id = $q->row()->currency_id;

                        $this->db->where("id", $currency_id);
					    $q = $this->db->get("currency");

                        if ($q->num_rows())
					    {
                            echo $q->row()->rate;
                        }
					}
				}
			}
		}
		else if (true)
		{
			$this->db->where("receiveditem_id", $by_id);
			$q = $this->db->get("receiveditemline");
			
			if ($q->num_rows())
			{
				$purchaseorderline_id = $q->row()->purchaseorderline_id;
				
				$this->db->where("id", $purchaseorderline_id);
				$q = $this->db->get("purchaseorderline");
				
				if ($q->num_rows())
				{
					$purchaseorder_id = $q->row()->purchaseorder_id;
					
					$this->db->where("id", $purchaseorder_id);
					$q = $this->db->get("purchaseorder");
					
					if ($q->num_rows())
					{
						echo $q->row()->{$field_to_get};
					}
				}
			}
		}
	}
}

?>
