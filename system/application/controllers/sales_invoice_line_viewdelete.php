<?php

class sales_invoice_line_viewdelete extends Controller {

	function sales_invoice_line_viewdelete()
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