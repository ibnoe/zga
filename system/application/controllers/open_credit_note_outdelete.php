<?php

class open_credit_note_outdelete extends Controller {

	function open_credit_note_outdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("creditnoteout", $data);
		//$this->db->delete("creditnoteout");
	}
}

?>