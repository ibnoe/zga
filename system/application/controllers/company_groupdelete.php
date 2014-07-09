<?php

class company_groupdelete extends Controller {

	function company_groupdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("customergroup", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('company_groupdelete','customergroup','delete', $id);
		//$this->db->delete("customergroup");
	}
}

?>