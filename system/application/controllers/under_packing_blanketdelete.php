<?php

class under_packing_blanketdelete extends Controller {

	function under_packing_blanketdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("underpackingblanket");
	}
}

?>