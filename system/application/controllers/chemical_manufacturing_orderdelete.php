<?php

class chemical_manufacturing_orderdelete extends Controller {

	function chemical_manufacturing_orderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("manufacturingorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('chemical_manufacturing_orderdelete','manufacturingorder','delete', $id);
		//$this->db->delete("manufacturingorder");
	}
}

?>