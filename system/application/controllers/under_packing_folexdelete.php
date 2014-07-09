<?php

class under_packing_folexdelete extends Controller {

	function under_packing_folexdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("itemzengraunderpackingfolex");
	}
}

?>