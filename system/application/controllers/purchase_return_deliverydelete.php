<?php

class purchase_return_deliverydelete extends Controller {

	function purchase_return_deliverydelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasereturndelivery", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_deliverydelete','purchasereturndelivery','delete', $id);
		//$this->db->delete("purchasereturndelivery");
	}
}

?>