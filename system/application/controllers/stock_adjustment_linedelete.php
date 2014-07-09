<?php

class stock_adjustment_linedelete extends Controller {

	function stock_adjustment_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("stockadjustmentline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('stock_adjustment_linedelete','stockadjustmentline','delete', $id);
		//$this->db->delete("stockadjustmentline");
	}
}

?>