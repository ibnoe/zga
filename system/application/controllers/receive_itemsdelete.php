<?php

class receive_itemsdelete extends Controller {

	function receive_itemsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("receiveditem", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('receive_itemsdelete','receiveditem','delete', $id);
		//$this->db->delete("receiveditem");
	}
}

?>