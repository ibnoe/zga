<?php

class suar_pengajuan_repairdelete extends Controller {

	function suar_pengajuan_repairdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("suratpengajuanrepair");
	}
}

?>