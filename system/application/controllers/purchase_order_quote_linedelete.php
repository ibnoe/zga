<?php

class purchase_order_quote_linedelete extends Controller {

	function purchase_order_quote_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("purchaseorderquoteline");
	}
}

?>