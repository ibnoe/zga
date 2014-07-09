<?php

class inking_unit_foildelete extends Controller {

	function inking_unit_foildelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("inkingunitfoil");
	}
}

?>