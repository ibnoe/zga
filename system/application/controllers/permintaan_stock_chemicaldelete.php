<?php

class permintaan_stock_chemicaldelete extends Controller {

	function permintaan_stock_chemicaldelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("permintaanstockchemical", $data);
		//$this->db->delete("permintaanstockchemical");
	}
}

?>