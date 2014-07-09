<?php

class purchase_return_invoice_get_fn extends Controller {

	function purchase_return_invoice_get_fn()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function get_by($field_to_get, $by_field, $by_id)
	{
		if ($field_to_get == "total")
		{
			$this->db->where("purchasereturndelivery_id", $by_id);
			$q = $this->db->get("purchasereturndeliveryline");
			
			$total = 0;
			foreach ($q->result() as $row)
			{
				$total += $row->subtotal;
			}
            echo $total;
		}
	    else if ($field_to_get == "currencyrate")
		{
			$this->db->where("purchasereturndelivery_id", $by_id);
			$q = $this->db->get("purchasereturndeliveryline");
			
			if ($q->num_rows())
			{
				$purchasereturnorderline_id = $q->row()->purchasereturnorderline_id;
				
				$this->db->where("id", $purchasereturnorderline_id);
				$q = $this->db->get("purchasereturnorderline");
				
				if ($q->num_rows())
				{
					$purchasereturnorder_id = $q->row()->purchasereturnorder_id;
					
					$this->db->where("id", $purchasereturnorder_id);
					$q = $this->db->get("purchasereturnorder");
					
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
			$this->db->where("purchasereturndelivery_id", $by_id);
			$q = $this->db->get("purchasereturndeliveryline");
			
			if ($q->num_rows())
			{
				$purchasereturnorderline_id = $q->row()->purchasereturnorderline_id;
				
				$this->db->where("id", $purchasereturnorderline_id);
				$q = $this->db->get("purchasereturnorderline");
				
				if ($q->num_rows())
				{
					$purchasereturnorder_id = $q->row()->purchasereturnorder_id;
					
					$this->db->where("id", $purchasereturnorder_id);
					$q = $this->db->get("purchasereturnorder");
					
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
