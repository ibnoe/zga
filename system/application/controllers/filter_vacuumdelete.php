<?php

class filter_vacuumdelete extends Controller {

	function filter_vacuumdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("filtervacuum");
	}
}

?>