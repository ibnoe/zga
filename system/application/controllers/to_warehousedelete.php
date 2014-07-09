<?php

class to_warehousedelete extends Controller {

	function to_warehousedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("warehouse", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('to_warehousedelete','warehouse','delete', $id);
		//$this->db->delete("warehouse");
	}
}

?>