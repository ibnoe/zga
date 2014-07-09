<?php

class manufacturing_reject_reasondelete extends Controller {

	function manufacturing_reject_reasondelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("manufacturingrejectreason", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('manufacturing_reject_reasondelete','manufacturingrejectreason','delete', $id);
		//$this->db->delete("manufacturingrejectreason");
	}
}

?>