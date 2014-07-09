<?php

class receive_items_for_invoicedelete extends Controller {

	function receive_items_for_invoicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("receiveditem", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('receive_items_for_invoicedelete','receiveditem','delete', $id);
		//$this->db->delete("receiveditem");
	}
}

?>