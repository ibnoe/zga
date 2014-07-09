<?php

class sales_return_invoice_linedelete extends Controller {

	function sales_return_invoice_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesreturninvoiceline", $data);
		//$this->db->delete("salesreturninvoiceline");
	}
}

?>