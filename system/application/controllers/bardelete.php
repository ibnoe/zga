<?php

class bardelete extends Controller {

	function bardelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('bardelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>