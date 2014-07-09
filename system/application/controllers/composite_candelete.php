<?php

class composite_candelete extends Controller {

	function composite_candelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("composite");
	}
}

?>