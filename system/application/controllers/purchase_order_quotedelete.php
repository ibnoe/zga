<?php

class purchase_order_quotedelete extends Controller {

	function purchase_order_quotedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("purchaseorderquote");
	}
}

?>