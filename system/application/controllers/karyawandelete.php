<?php

class karyawandelete extends Controller {

	function karyawandelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("karyawan", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('karyawandelete','karyawan','delete', $id);
		//$this->db->delete("karyawan");
	}
}

?>