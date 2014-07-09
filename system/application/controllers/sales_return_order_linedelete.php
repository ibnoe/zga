<?php

class sales_return_order_linedelete extends Controller {

	function sales_return_order_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesreturnorderline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_order_linedelete','salesreturnorderline','delete', $id);
		//$this->db->delete("salesreturnorderline");
	}
}

?>