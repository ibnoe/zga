<?php

class sales_paymentdelete extends Controller {

	function sales_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salespayment", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_paymentdelete','salespayment','delete', $id);
		//$this->db->delete("salespayment");
	}
}

?>