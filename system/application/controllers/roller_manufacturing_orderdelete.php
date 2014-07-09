<?php

class roller_manufacturing_orderdelete extends Controller {

	function roller_manufacturing_orderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("manufacturingorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('roller_manufacturing_orderdelete','manufacturingorder','delete', $id);
		//$this->db->delete("manufacturingorder");
	}
}

?>