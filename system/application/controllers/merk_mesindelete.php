<?php

class merk_mesindelete extends Controller {

	function merk_mesindelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("merkmesin", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('merk_mesindelete','merkmesin','delete', $id);
		//$this->db->delete("merkmesin");
	}
}

?>