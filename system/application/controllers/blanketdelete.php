<?php

class blanketdelete extends Controller {

	function blanketdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('blanketdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>