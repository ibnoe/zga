<?php

class rcndelete extends Controller {

	function rcndelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rcn", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('rcndelete','rcn','delete', $id);
		//$this->db->delete("rcn");
	}
}

?>