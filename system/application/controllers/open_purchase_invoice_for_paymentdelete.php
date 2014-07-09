<?php

class open_purchase_invoice_for_paymentdelete extends Controller {

	function open_purchase_invoice_for_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("purchaseinvoice");
	}
}

?>