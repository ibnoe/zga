<?php

class price_delete_linedelete extends Controller {

	function price_delete_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("pricelistline");
	}
}

?>