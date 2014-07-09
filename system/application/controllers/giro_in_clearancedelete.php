<?php

class giro_in_clearancedelete extends Controller {

	function giro_in_clearancedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("giroinclearance", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('giro_in_clearancedelete','giroinclearance','delete', $id);
		//$this->db->delete("giroinclearance");
	}
}

?>