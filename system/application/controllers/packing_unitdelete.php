<?php

class packing_unitdelete extends Controller {

	function packing_unitdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("packingunit", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('packing_unitdelete','packingunit','delete', $id);
		//$this->db->delete("packingunit");
	}
}

?>