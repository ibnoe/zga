<?php

class purchase_order_open_paymentdelete extends Controller {

	function purchase_order_open_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchaseorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_order_open_paymentdelete','purchaseorder','delete', $id);
		//$this->db->delete("purchaseorder");
	}
}

?>