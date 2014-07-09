<?php

class purchase_returndelete extends Controller {

	function purchase_returndelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("preturn");
	}
}

?>