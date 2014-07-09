<?php

class accessoriesdelete extends Controller {

	function accessoriesdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('accessoriesdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>