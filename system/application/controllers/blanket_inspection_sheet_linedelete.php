<?php

class blanket_inspection_sheet_linedelete extends Controller {

	function blanket_inspection_sheet_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("blanketinspectionsheetline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('blanket_inspection_sheet_linedelete','blanketinspectionsheetline','delete', $id);
		//$this->db->delete("blanketinspectionsheetline");
	}
}

?>