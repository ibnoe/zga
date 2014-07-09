<?php

class purchase_payment_linedelete extends Controller {

	function purchase_payment_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasepaymentline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_payment_linedelete','purchasepaymentline','delete', $id);
		//$this->db->delete("purchasepaymentline");
	}
}

?>