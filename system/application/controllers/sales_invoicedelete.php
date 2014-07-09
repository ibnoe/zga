<?php

class sales_invoicedelete extends Controller {

	function sales_invoicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesinvoice", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_invoicedelete','salesinvoice','delete', $id);
		//$this->db->delete("salesinvoice");
	}
}

?>