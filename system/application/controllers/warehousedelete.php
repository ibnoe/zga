<?php

class warehousedelete extends Controller {

	function warehousedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("warehouse", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('warehousedelete','warehouse','delete', $id);
		//$this->db->delete("warehouse");
	}
}

?>