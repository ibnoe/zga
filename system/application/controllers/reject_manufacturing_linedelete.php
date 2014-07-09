<?php

class reject_manufacturing_linedelete extends Controller {

	function reject_manufacturing_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rejectmanufacturingline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('reject_manufacturing_linedelete','rejectmanufacturingline','delete', $id);
		//$this->db->delete("rejectmanufacturingline");
	}
}

?>