<?php

class sales_return_invoicedelete extends Controller {

	function sales_return_invoicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesreturninvoice", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_invoicedelete','salesreturninvoice','delete', $id);
		//$this->db->delete("salesreturninvoice");
	}
}

?>