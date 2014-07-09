<?php

class permintaan_stock_chemical_linedelete extends Controller {

	function permintaan_stock_chemical_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("permintaanstockchemicalline", $data);
		//$this->db->delete("permintaanstockchemicalline");
	}
}

?>