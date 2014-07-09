<?php

class sales_return_delivery_linedelete extends Controller {

	function sales_return_delivery_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesreturndeliveryline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_delivery_linedelete','salesreturndeliveryline','delete', $id);
		//$this->db->delete("salesreturndeliveryline");
	}
}

?>