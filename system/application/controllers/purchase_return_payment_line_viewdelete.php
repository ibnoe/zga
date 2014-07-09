<?php

class purchase_return_payment_line_viewdelete extends Controller {

	function purchase_return_payment_line_viewdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturnpaymentline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_payment_line_viewdelete','purchasereturnpaymentline','delete', $id);
		//$this->db->delete("purchasereturnpaymentline");
	}
}

?>