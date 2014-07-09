<?php

class sent_customers_itemsdelete extends Controller {

	function sent_customers_itemsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("deliveryorderline");
	}
}

?>