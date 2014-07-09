<?php

class supplierdelete extends Controller {

	function supplierdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("supplier", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('supplierdelete','supplier','delete', $id);
		//$this->db->delete("supplier");
	}
}

?>