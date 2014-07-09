<?php

class giro_out_clearance_line_viewdelete extends Controller {

	function giro_out_clearance_line_viewdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("girooutclearanceline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('giro_out_clearance_line_viewdelete','girooutclearanceline','delete', $id);
		//$this->db->delete("girooutclearanceline");
	}
}

?>