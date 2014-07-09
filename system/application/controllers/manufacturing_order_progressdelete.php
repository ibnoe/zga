<?php

class manufacturing_order_progressdelete extends Controller {

	function manufacturing_order_progressdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("manufacturingorder");
	}
}

?>