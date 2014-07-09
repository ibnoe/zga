<?php

class sales_orderdelete extends Controller {

	function sales_orderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_orderdelete','salesorder','delete', $id);
		//$this->db->delete("salesorder");
	}
}

?>