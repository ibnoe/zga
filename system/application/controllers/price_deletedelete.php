<?php

class price_deletedelete extends Controller {

	function price_deletedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("pricelist");
	}
}

?>