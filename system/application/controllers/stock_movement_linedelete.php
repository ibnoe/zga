<?php

class stock_movement_linedelete extends Controller {

	function stock_movement_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("moveactionline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('stock_movement_linedelete','moveactionline','delete', $id);
		//$this->db->delete("moveactionline");
	}
}

?>