<?php

class itemdelete extends Controller {

	function itemdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('itemdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>