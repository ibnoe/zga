<?php

class compounddelete extends Controller {

	function compounddelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('compounddelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>