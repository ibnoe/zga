<?php

class forwarderdelete extends Controller {

	function forwarderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("forwarder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('forwarderdelete','forwarder','delete', $id);
		//$this->db->delete("forwarder");
	}
}

?>