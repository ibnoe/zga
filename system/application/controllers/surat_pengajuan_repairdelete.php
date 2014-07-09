<?php

class surat_pengajuan_repairdelete extends Controller {

	function surat_pengajuan_repairdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("suratpengajuanrepair", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('surat_pengajuan_repairdelete','suratpengajuanrepair','delete', $id);
		//$this->db->delete("suratpengajuanrepair");
	}
}

?>