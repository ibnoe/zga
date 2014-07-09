<?php

class received_suppliers_itemsdelete extends Controller {

	function received_suppliers_itemsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("receiveditemline");
	}
}

?>