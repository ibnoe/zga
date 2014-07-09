<?php

class purchase_return_delivery_for_invoicedelete extends Controller {

	function purchase_return_delivery_for_invoicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturndelivery", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_delivery_for_invoicedelete','purchasereturndelivery','delete', $id);
		//$this->db->delete("purchasereturndelivery");
	}
}

?>