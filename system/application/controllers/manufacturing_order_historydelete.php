<?php

class manufacturing_order_historydelete extends Controller {

	function manufacturing_order_historydelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("manufacturingorderdone", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('manufacturing_order_historydelete','manufacturingorderdone','delete', $id);
		//$this->db->delete("manufacturingorderdone");
	}
}

?>