<?php

class purchase_return_invoicedelete extends Controller {

	function purchase_return_invoicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturninvoice", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_invoicedelete','purchasereturninvoice','delete', $id);
		//$this->db->delete("purchasereturninvoice");
	}
}

?>