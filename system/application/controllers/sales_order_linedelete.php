<?php

class sales_order_linedelete extends Controller {

	function sales_order_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesorderline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_order_linedelete','salesorderline','delete', $id);
		//$this->db->delete("salesorderline");
	}
}

?>