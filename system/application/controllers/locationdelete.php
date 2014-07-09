<?php

class locationdelete extends Controller {

	function locationdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("contact");
	}
}

?>