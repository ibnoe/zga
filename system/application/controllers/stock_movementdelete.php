<?php

class stock_movementdelete extends Controller {

	function stock_movementdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("moveaction", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('stock_movementdelete','moveaction','delete', $id);
		//$this->db->delete("moveaction");
	}
}

?>