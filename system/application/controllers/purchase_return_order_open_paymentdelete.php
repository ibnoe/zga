<?php

class purchase_return_order_open_paymentdelete extends Controller {

	function purchase_return_order_open_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturnorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_order_open_paymentdelete','purchasereturnorder','delete', $id);
		//$this->db->delete("purchasereturnorder");
	}
}

?>