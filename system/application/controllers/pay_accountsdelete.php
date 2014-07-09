<?php

class pay_accountsdelete extends Controller {

	function pay_accountsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("coa", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('pay_accountsdelete','coa','delete', $id);
		//$this->db->delete("coa");
	}
}

?>