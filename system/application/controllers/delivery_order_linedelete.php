<?php

class delivery_order_linedelete extends Controller {

	function delivery_order_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("deliveryorderline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('delivery_order_linedelete','deliveryorderline','delete', $id);
		//$this->db->delete("deliveryorderline");
	}
}

?>