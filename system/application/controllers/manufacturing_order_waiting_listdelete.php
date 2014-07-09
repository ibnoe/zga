<?php

class manufacturing_order_waiting_listdelete extends Controller {

	function manufacturing_order_waiting_listdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("manufacturingorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('manufacturing_order_waiting_listdelete','manufacturingorder','delete', $id);
		//$this->db->delete("manufacturingorder");
	}
}

?>