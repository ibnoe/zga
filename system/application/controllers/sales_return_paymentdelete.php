<?php

class sales_return_paymentdelete extends Controller {

	function sales_return_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesreturnpayment", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_paymentdelete','salesreturnpayment','delete', $id);
		//$this->db->delete("salesreturnpayment");
	}
}

?>