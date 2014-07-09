<?php

class blanket_inspection_sheetdelete extends Controller {

	function blanket_inspection_sheetdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("blanketinspectionsheet", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('blanket_inspection_sheetdelete','blanketinspectionsheet','delete', $id);
		//$this->db->delete("blanketinspectionsheet");
	}
}

?>