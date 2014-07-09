<?php

class sales_return_order_open_paymentdelete extends Controller {

	function sales_return_order_open_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesreturnorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_order_open_paymentdelete','salesreturnorder','delete', $id);
		//$this->db->delete("salesreturnorder");
	}
}

?>