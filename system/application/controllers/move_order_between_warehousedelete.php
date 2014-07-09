<?php

class move_order_between_warehousedelete extends Controller {

	function move_order_between_warehousedelete()
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