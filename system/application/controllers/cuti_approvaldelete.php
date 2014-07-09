<?php

class cuti_approvaldelete extends Controller {

	function cuti_approvaldelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("cutiklaim", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('cuti_approvaldelete','cutiklaim','delete', $id);
		//$this->db->delete("cutiklaim");
	}
}

?>