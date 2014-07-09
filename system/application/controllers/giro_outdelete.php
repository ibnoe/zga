<?php

class giro_outdelete extends Controller {

	function giro_outdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("giroout", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('giro_outdelete','giroout','delete', $id);
		//$this->db->delete("giroout");
	}
}

?>