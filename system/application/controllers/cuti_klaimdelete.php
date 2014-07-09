<?php

class cuti_klaimdelete extends Controller {

	function cuti_klaimdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("cutiklaim", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('cuti_klaimdelete','cutiklaim','delete', $id);
		//$this->db->delete("cutiklaim");
	}
}

?>