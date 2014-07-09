<?php

class blanket_manufacturing_orderdelete extends Controller {

	function blanket_manufacturing_orderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("manufacturingorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('blanket_manufacturing_orderdelete','manufacturingorder','delete', $id);
		//$this->db->delete("manufacturingorder");
	}
}

?>