<?php

class purchase_return_paymentdelete extends Controller {

	function purchase_return_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturnpayment", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_paymentdelete','purchasereturnpayment','delete', $id);
		//$this->db->delete("purchasereturnpayment");
	}
}

?>