<?php

class permintaan_stock_linedelete extends Controller {

	function permintaan_stock_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("permintaanstockline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('permintaan_stock_linedelete','permintaanstockline','delete', $id);
		//$this->db->delete("permintaanstockline");
	}
}

?>