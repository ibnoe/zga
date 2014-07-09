<?php

class open_purchase_orderdelete extends Controller {

	function open_purchase_orderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("porder");
	}
}

?>