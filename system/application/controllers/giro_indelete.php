<?php

class giro_indelete extends Controller {

	function giro_indelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("giroin", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('giro_indelete','giroin','delete', $id);
		//$this->db->delete("giroin");
	}
}

?>