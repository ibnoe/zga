<?php

class manufacturing_rejectdelete extends Controller {

	function manufacturing_rejectdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("manufacturingreject", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('manufacturing_rejectdelete','manufacturingreject','delete', $id);
		//$this->db->delete("manufacturingreject");
	}
}

?>