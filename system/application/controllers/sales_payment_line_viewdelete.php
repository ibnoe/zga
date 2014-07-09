<?php

class sales_payment_line_viewdelete extends Controller {

	function sales_payment_line_viewdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salespaymentline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_payment_line_viewdelete','salespaymentline','delete', $id);
		//$this->db->delete("salespaymentline");
	}
}

?>