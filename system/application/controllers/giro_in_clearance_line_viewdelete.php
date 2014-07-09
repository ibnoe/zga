<?php

class giro_in_clearance_line_viewdelete extends Controller {

	function giro_in_clearance_line_viewdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("giroinclearanceline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('giro_in_clearance_line_viewdelete','giroinclearanceline','delete', $id);
		//$this->db->delete("giroinclearanceline");
	}
}

?>