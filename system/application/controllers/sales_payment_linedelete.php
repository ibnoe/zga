<?php

class sales_payment_linedelete extends Controller {

	function sales_payment_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salespaymentline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_payment_linedelete','salespaymentline','delete', $id);
		//$this->db->delete("salespaymentline");
	}
}

?>