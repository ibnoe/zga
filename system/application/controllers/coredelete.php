<?php

class coredelete extends Controller {

	function coredelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('coredelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>