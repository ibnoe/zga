<?php

class chemicaldelete extends Controller {

	function chemicaldelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('chemicaldelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>