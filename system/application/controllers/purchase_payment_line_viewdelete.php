<?php

class purchase_payment_line_viewdelete extends Controller {

	function purchase_payment_line_viewdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchasepaymentline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_payment_line_viewdelete','purchasepaymentline','delete', $id);
		//$this->db->delete("purchasepaymentline");
	}
}

?>