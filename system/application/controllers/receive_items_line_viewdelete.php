<?php

class receive_items_line_viewdelete extends Controller {

	function receive_items_line_viewdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("receiveditemline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('receive_items_line_viewdelete','receiveditemline','delete', $id);
		//$this->db->delete("receiveditemline");
	}
}

?>