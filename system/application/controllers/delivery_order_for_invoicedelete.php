<?php

class delivery_order_for_invoicedelete extends Controller {

	function delivery_order_for_invoicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("deliveryorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('delivery_order_for_invoicedelete','deliveryorder','delete', $id);
		//$this->db->delete("deliveryorder");
	}
}

?>