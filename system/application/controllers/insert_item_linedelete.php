<?php

class insert_item_linedelete extends Controller {

	function insert_item_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("insertitemline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('insert_item_linedelete','insertitemline','delete', $id);
		//$this->db->delete("insertitemline");
	}
}

?>