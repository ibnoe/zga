<?php

class insert_itemdelete extends Controller {

	function insert_itemdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("insertitem", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('insert_itemdelete','insertitem','delete', $id);
		//$this->db->delete("insertitem");
	}
}

?>