<?php

class packagingdelete extends Controller {

	function packagingdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('packagingdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>