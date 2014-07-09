<?php

class from_warehousedelete extends Controller {

	function from_warehousedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("warehouse", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('from_warehousedelete','warehouse','delete', $id);
		//$this->db->delete("warehouse");
	}
}

?>