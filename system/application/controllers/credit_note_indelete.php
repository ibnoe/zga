<?php

class credit_note_indelete extends Controller {

	function credit_note_indelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("creditnotein", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('credit_note_indelete','creditnotein','delete', $id);
		//$this->db->delete("creditnotein");
	}
}

?>