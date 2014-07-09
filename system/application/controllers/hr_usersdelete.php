<?php

class hr_usersdelete extends Controller {

	function hr_usersdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("users", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('hr_usersdelete','users','delete', $id);
		//$this->db->delete("users");
	}
}

?>