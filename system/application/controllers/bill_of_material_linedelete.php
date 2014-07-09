<?php

class bill_of_material_linedelete extends Controller {

	function bill_of_material_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("bomline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('bill_of_material_linedelete','bomline','delete', $id);
		//$this->db->delete("bomline");
	}
}

?>