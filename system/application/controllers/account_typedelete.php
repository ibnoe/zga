<?php

class account_typedelete extends Controller {

	function account_typedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("coatype", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('account_typedelete','coatype','delete', $id);
		//$this->db->delete("coatype");
	}
}

?>