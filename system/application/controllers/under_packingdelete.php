<?php

class under_packingdelete extends Controller {

	function under_packingdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('under_packingdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>