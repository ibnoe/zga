<?php

class purchase_return_payment_linedelete extends Controller {

	function purchase_return_payment_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturnpaymentline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_payment_linedelete','purchasereturnpaymentline','delete', $id);
		//$this->db->delete("purchasereturnpaymentline");
	}
}

?>