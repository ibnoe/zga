<?php

class roll_rcndelete extends Controller {

	function roll_rcndelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('roll_rcndelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>