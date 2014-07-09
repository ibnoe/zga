<?php

class giro_out_clearancedelete extends Controller {

	function giro_out_clearancedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("girooutclearance", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('giro_out_clearancedelete','girooutclearance','delete', $id);
		//$this->db->delete("girooutclearance");
	}
}

?>