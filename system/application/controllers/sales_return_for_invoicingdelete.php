<?php

class sales_return_for_invoicingdelete extends Controller {

	function sales_return_for_invoicingdelete()
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