<?php

class marketing_officerdelete extends Controller {

	function marketing_officerdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("marketingofficer", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('marketing_officerdelete','marketingofficer','delete', $id);
		//$this->db->delete("marketingofficer");
	}
}

?>