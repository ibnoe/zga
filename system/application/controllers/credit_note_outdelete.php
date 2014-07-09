<?php

class credit_note_outdelete extends Controller {

	function credit_note_outdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("creditnoteout", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('credit_note_outdelete','creditnoteout','delete', $id);
		//$this->db->delete("creditnoteout");
	}
}

?>