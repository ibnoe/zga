<?php

class penambahan_stock_chemicaldelete extends Controller {

	function penambahan_stock_chemicaldelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("penambahanstockchemical", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('penambahan_stock_chemicaldelete','penambahanstockchemical','delete', $id);
		//$this->db->delete("penambahanstockchemical");
	}
}

?>