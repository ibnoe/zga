<?php

class accountsdelete extends Controller {

	function accountsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("coa", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('accountsdelete','coa','delete', $id);
		//$this->db->delete("coa");
	}
}

?>