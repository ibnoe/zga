<?php

class contact_persondelete extends Controller {

	function contact_persondelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("contactperson", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('contact_persondelete','contactperson','delete', $id);
		//$this->db->delete("contactperson");
	}
}

?>