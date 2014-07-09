<?php

class sppdelete extends Controller {

	function sppdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("suratpermintaanpembelian", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sppdelete','suratpermintaanpembelian','delete', $id);
		//$this->db->delete("suratpermintaanpembelian");
	}
}

?>