<?php

class depreciation_accountsdelete extends Controller {

	function depreciation_accountsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("coa", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('depreciation_accountsdelete','coa','delete', $id);
		//$this->db->delete("coa");
	}
}

?>