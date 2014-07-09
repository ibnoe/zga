<?php

class purchase_return_order_linedelete extends Controller {

	function purchase_return_order_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturnorderline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_order_linedelete','purchasereturnorderline','delete', $id);
		//$this->db->delete("purchasereturnorderline");
	}
}

?>