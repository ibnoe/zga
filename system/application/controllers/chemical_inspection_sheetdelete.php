<?php

class chemical_inspection_sheetdelete extends Controller {

	function chemical_inspection_sheetdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("chemicalinspectionsheet", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('chemical_inspection_sheetdelete','chemicalinspectionsheet','delete', $id);
		//$this->db->delete("chemicalinspectionsheet");
	}
}

?>