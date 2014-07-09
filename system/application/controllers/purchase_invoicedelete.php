<?php

class purchase_invoicedelete extends Controller {

	function purchase_invoicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchaseinvoice", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_invoicedelete','purchaseinvoice','delete', $id);
		//$this->db->delete("purchaseinvoice");
	}
}

?>