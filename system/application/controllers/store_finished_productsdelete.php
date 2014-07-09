<?php

class store_finished_productsdelete extends Controller {

	function store_finished_productsdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("morder");
	}
}

?>