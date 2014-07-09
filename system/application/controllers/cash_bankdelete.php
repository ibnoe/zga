<?php

class cash_bankdelete extends Controller {

	function cash_bankdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("cashbank", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('cash_bankdelete','cashbank','delete', $id);
		//$this->db->delete("cashbank");
	}
}

?>