<?php

class move_orderdelete extends Controller {

	function move_orderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("moveorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('move_orderdelete','moveorder','delete', $id);
		//$this->db->delete("moveorder");
	}
}

?>