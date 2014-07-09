<?php

class journal_manualdelete extends Controller {

	function journal_manualdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("journalmanual", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('journal_manualdelete','journalmanual','delete', $id);
		//$this->db->delete("journalmanual");
	}
}

?>