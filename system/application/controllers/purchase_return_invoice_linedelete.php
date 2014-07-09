<?php

class purchase_return_invoice_linedelete extends Controller {

	function purchase_return_invoice_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturninvoiceline", $data);
		//$this->db->delete("purchasereturninvoiceline");
	}
}

?>