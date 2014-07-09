<?php

class sales_return_invoice_line_viewdelete extends Controller {

	function sales_return_invoice_line_viewdelete()
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