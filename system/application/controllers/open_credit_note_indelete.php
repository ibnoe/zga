<?php

class open_credit_note_indelete extends Controller {

	function open_credit_note_indelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("creditnotein", $data);
		//$this->db->delete("creditnotein");
	}
}

?>