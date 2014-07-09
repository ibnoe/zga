<?php

class manufacturing_order_done_linedelete extends Controller {

	function manufacturing_order_done_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("manufacturingorderdoneline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('manufacturing_order_done_linedelete','manufacturingorderdoneline','delete', $id);
		//$this->db->delete("manufacturingorderdoneline");
	}
}

?>