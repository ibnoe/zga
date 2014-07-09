<?php

class customerdelete extends Controller {

	function customerdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("customer", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('customerdelete','customer','delete', $id);
		//$this->db->delete("customer");
	}
}

?>