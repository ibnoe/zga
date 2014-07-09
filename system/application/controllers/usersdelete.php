<?php

class usersdelete extends Controller {

	function usersdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("users", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('usersdelete','users','delete', $id);
		//$this->db->delete("users");
	}
}

?>