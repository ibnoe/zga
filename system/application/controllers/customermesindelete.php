<?php

class customermesindelete extends Controller {

	function customermesindelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("customermesin", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('customermesindelete','customermesin','delete', $id);
		//$this->db->delete("customermesin");
	}
}

?>