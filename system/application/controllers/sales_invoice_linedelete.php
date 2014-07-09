<?php

class sales_invoice_linedelete extends Controller {

	function sales_invoice_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesinvoiceline", $data);
		//$this->db->delete("salesinvoiceline");
	}
}

?>