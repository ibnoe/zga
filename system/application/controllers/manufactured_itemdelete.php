<?php

class manufactured_itemdelete extends Controller {

	function manufactured_itemdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('manufactured_itemdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>