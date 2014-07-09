<?php

class sales_returndelete extends Controller {

	function sales_returndelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("sreturn");
	}
}

?>