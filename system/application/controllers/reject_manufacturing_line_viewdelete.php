<?php

class reject_manufacturing_line_viewdelete extends Controller {

	function reject_manufacturing_line_viewdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rejectmanufacturingline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('reject_manufacturing_line_viewdelete','rejectmanufacturingline','delete', $id);
		//$this->db->delete("rejectmanufacturingline");
	}
}

?>