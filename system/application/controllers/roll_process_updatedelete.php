<?php

class roll_process_updatedelete extends Controller {

	function roll_process_updatedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rollprocessupdate", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('roll_process_updatedelete','rollprocessupdate','delete', $id);
		//$this->db->delete("rollprocessupdate");
	}
}

?>