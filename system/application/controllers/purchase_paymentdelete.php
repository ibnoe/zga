<?php

class purchase_paymentdelete extends Controller {

	function purchase_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasepayment", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_paymentdelete','purchasepayment','delete', $id);
		//$this->db->delete("purchasepayment");
	}
}

?>