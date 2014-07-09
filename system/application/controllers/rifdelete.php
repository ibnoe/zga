<?php

class rifdelete extends Controller {

	function rifdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rcn", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('rifdelete','rcn','delete', $id);
		//$this->db->delete("rcn");
	}
}

?>