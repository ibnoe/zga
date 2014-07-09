<?php

class sales_order_open_paymentdelete extends Controller {

	function sales_order_open_paymentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_order_open_paymentdelete','salesorder','delete', $id);
		//$this->db->delete("salesorder");
	}
}

?>