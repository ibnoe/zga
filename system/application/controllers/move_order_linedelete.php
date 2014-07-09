<?php

class move_order_linedelete extends Controller {

	function move_order_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("moveorderline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('move_order_linedelete','moveorderline','delete', $id);
		//$this->db->delete("moveorderline");
	}
}

?>