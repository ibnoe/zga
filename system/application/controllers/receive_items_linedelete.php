<?php

class receive_items_linedelete extends Controller {

	function receive_items_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("receiveditemline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('receive_items_linedelete','receiveditemline','delete', $id);
		//$this->db->delete("receiveditemline");
	}
}

?>