<?php

class open_sales_invoice_for_paymentdelete extends Controller {

	function open_sales_invoice_for_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("salesinvoice");
	}
}

?>