<?php

class mesindelete extends Controller {

	function mesindelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("mesin", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('mesindelete','mesin','delete', $id);
		//$this->db->delete("mesin");
	}
}

?>