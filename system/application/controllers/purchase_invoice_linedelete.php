<?php

class purchase_invoice_linedelete extends Controller {

	function purchase_invoice_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("purchaseinvoiceline", $data);
		//$this->db->delete("purchaseinvoiceline");
	}
}

?>