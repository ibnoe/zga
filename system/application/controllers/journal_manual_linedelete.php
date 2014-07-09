<?php

class journal_manual_linedelete extends Controller {

	function journal_manual_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("journal", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('journal_manual_linedelete','journal','delete', $id);
		//$this->db->delete("journal");
	}
}

?>