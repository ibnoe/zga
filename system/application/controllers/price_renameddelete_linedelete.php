<?php

class price_renameddelete_linedelete extends Controller {

	function price_renameddelete_linedelete()
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