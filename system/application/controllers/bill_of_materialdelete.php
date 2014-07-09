<?php

class bill_of_materialdelete extends Controller {

	function bill_of_materialdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("bom", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('bill_of_materialdelete','bom','delete', $id);
		//$this->db->delete("bom");
	}
}

?>