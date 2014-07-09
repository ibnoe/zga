<?php

class supplier_3delete extends Controller {

	function supplier_3delete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("supplier", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('supplier_3delete','supplier','delete', $id);
		//$this->db->delete("supplier");
	}
}

?>