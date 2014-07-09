<?php

class sales_return_delivery_for_invoicedelete extends Controller {

	function sales_return_delivery_for_invoicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesreturndelivery", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_delivery_for_invoicedelete','salesreturndelivery','delete', $id);
		//$this->db->delete("salesreturndelivery");
	}
}

?>