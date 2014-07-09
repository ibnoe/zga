<?php

class inkdelete extends Controller {

	function inkdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('inkdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>