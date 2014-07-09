<?php

class roller_inspection_sheetdelete extends Controller {

	function roller_inspection_sheetdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rollerinspectionsheet", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('roller_inspection_sheetdelete','rollerinspectionsheet','delete', $id);
		//$this->db->delete("rollerinspectionsheet");
	}
}

?>