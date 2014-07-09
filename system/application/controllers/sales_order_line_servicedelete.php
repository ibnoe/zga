<?php

class sales_order_line_servicedelete extends Controller {

	function sales_order_line_servicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("salesorderline");
	}
}

?>