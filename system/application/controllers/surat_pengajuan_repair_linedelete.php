<?php

class surat_pengajuan_repair_linedelete extends Controller {

	function surat_pengajuan_repair_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("suratpengajuanrepairline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('surat_pengajuan_repair_linedelete','suratpengajuanrepairline','delete', $id);
		//$this->db->delete("suratpengajuanrepairline");
	}
}

?>