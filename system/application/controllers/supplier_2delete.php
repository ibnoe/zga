<?php

class supplier_2delete extends Controller {

	function supplier_2delete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("supplier", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('supplier_2delete','supplier','delete', $id);
		//$this->db->delete("supplier");
	}
}

?>