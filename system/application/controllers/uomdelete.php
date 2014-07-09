<?php

class uomdelete extends Controller {

	function uomdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("uom", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('uomdelete','uom','delete', $id);
		//$this->db->delete("uom");
	}
}

?>