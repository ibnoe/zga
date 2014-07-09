<?php

class rolldelete extends Controller {

	function rolldelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('rolldelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>