<?php

class permintaan_stockdelete extends Controller {

	function permintaan_stockdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("permintaanstock", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('permintaan_stockdelete','permintaanstock','delete', $id);
		//$this->db->delete("permintaanstock");
	}
}

?>