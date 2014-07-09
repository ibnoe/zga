<?php

class karyawan_probationdelete extends Controller {

	function karyawan_probationdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("karyawan", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('karyawan_probationdelete','karyawan','delete', $id);
		//$this->db->delete("karyawan");
	}
}

?>