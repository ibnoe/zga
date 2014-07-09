<?php

class sales_invoice_get_fn extends Controller {

	function sales_invoice_get_fn()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function get_by($field_to_get, $by_field, $by_id)
	{
		if ($field_to_get == "total")
		{
			$this->db->where("deliveryorder_id", $by_id);
			$q = $this->db->get("deliveryorderline");
			
			$total = 0;
			foreach ($q->result() as $row)
			{
				$total += $row->subtotal;
			}
            echo $total;
		}
	    else if ($field_to_get == "currencyrate")
		{
			$this->db->where("deliveryorder_id", $by_id);
			$q = $this->db->get("deliveryorderline");
			
			if ($q->num_rows())
			{
				$salesorderline_id = $q->row()->salesorderline_id;
				
				$this->db->where("id", $salesorderline_id);
				$q = $this->db->get("salesorderline");
				
				if ($q->num_rows())
				{
					$salesorder_id = $q->row()->salesorder_id;
					
					$this->db->where("id", $salesorder_id);
					$q = $this->db->get("salesorder");
					
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
			$this->db->where("deliveryorder_id", $by_id);
			$q = $this->db->get("deliveryorderline");
			
			if ($q->num_rows())
			{
				$salesorderline_id = $q->row()->salesorderline_id;
				
				$this->db->where("id", $salesorderline_id);
				$q = $this->db->get("salesorderline");
				
				if ($q->num_rows())
				{
					$salesorder_id = $q->row()->salesorder_id;
					
					$this->db->where("id", $salesorder_id);
					$q = $this->db->get("salesorder");
					
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
