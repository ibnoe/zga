<?php

class open_order_for_invoicingdelete extends Controller {

	function open_order_for_invoicingdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("purchaseorderline");
	}
}

?>