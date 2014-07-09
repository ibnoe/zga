<?php

class accumulated_accountsdelete extends Controller {

	function accumulated_accountsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("coa", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('accumulated_accountsdelete','coa','delete', $id);
		//$this->db->delete("coa");
	}
}

?>