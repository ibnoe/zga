<?php

class stock_adjustmentdelete extends Controller {

	function stock_adjustmentdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("stockadjustment", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('stock_adjustmentdelete','stockadjustment','delete', $id);
		//$this->db->delete("stockadjustment");
	}
}

?>