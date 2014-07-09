<?php

class reject_manufacturingdelete extends Controller {

	function reject_manufacturingdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rejectmanufacturing", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('reject_manufacturingdelete','rejectmanufacturing','delete', $id);
		//$this->db->delete("rejectmanufacturing");
	}
}

?>