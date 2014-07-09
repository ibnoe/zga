<?php

class other_itemdelete extends Controller {

	function other_itemdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("item");
	}
}

?>