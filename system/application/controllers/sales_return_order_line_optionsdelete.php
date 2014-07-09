<?php

class sales_return_order_line_optionsdelete extends Controller {

	function sales_return_order_line_optionsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("salesreturnorderline");
	}
}

?>