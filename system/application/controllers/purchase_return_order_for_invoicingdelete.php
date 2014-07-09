<?php

class purchase_return_order_for_invoicingdelete extends Controller {

	function purchase_return_order_for_invoicingdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("purchasereturnorderline");
	}
}

?>