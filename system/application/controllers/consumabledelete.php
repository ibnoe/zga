<?php

class consumabledelete extends Controller {

	function consumabledelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('consumabledelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>