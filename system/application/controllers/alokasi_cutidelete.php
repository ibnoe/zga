<?php

class alokasi_cutidelete extends Controller {

	function alokasi_cutidelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("cutiallowance", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('alokasi_cutidelete','cutiallowance','delete', $id);
		//$this->db->delete("cutiallowance");
	}
}

?>