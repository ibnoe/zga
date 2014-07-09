<?php

class sales_return_invoice_get_fn extends Controller {

	function sales_return_invoice_get_fn()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function get_by($field_to_get, $by_field, $by_id)
	{
		if ($field_to_get == "total")
		{
			$this->db->where("salesreturndelivery_id", $by_id);
			$q = $this->db->get("salesreturndeliveryline");
			
			$total = 0;
			foreach ($q->result() as $row)
			{
				$total += $row->subtotal;
			}
            echo $total;
		}
	    else if ($field_to_get == "currencyrate")
		{
			$this->db->where("salesreturndelivery_id", $by_id);
			$q = $this->db->get("salesreturndeliveryline");
			
			if ($q->num_rows())
			{
				$salesreturnorderline_id = $q->row()->salesreturnorderline_id;
				
				$this->db->where("id", $salesreturnorderline_id);
				$q = $this->db->get("salesreturnorderline");
				
				if ($q->num_rows())
				{
					$salesreturnorder_id = $q->row()->salesreturnorder_id;
					
					$this->db->where("id", $salesreturnorder_id);
					$q = $this->db->get("salesreturnorder");
					
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
			$this->db->where("salesreturndelivery_id", $by_id);
			$q = $this->db->get("salesreturndeliveryline");
			
			if ($q->num_rows())
			{
				$salesreturnorderline_id = $q->row()->salesreturnorderline_id;
				
				$this->db->where("id", $salesreturnorderline_id);
				$q = $this->db->get("salesreturnorderline");
				
				if ($q->num_rows())
				{
					$salesreturnorder_id = $q->row()->salesreturnorder_id;
					
					$this->db->where("id", $salesreturnorder_id);
					$q = $this->db->get("salesreturnorder");
					
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
