<?php

class sales_return_payment_linedelete extends Controller {

	function sales_return_payment_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesreturnpaymentline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_payment_linedelete','salesreturnpaymentline','delete', $id);
		//$this->db->delete("salesreturnpaymentline");
	}
}

?>