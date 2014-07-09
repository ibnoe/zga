<?php

class purchase_order_linedelete extends Controller {

	function purchase_order_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchaseorderline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_order_linedelete','purchaseorderline','delete', $id);
		//$this->db->delete("purchaseorderline");
	}
}

?>