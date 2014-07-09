<?php

class delivery_orderdelete extends Controller {

	function delivery_orderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("deliveryorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('delivery_orderdelete','deliveryorder','delete', $id);
		//$this->db->delete("deliveryorder");
	}
}

?>