<?php

class chemical_work_instructiondelete extends Controller {

	function chemical_work_instructiondelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("chemicalworkinstruction", $data);
		//$this->db->delete("chemicalworkinstruction");
	}
}

?>