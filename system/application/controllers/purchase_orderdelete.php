<?php

class purchase_orderdelete extends Controller {

	function purchase_orderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchaseorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_orderdelete','purchaseorder','delete', $id);
		//$this->db->delete("purchaseorder");
	}
}

?>