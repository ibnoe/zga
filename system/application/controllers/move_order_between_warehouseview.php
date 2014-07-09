<?php

class move_order_between_warehouseview extends Controller {

	function move_order_between_warehouseview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($move_order_between_warehouse_id=0)
	{
		
$q = $this->db->where('id', $move_order_between_warehouse_id);
$q = $this->db->get('porder');
if ($q->num_rows() > 0) {
$data = array();
$data['move_order_between_warehouse_id'] = $move_order_between_warehouse_id;
foreach ($q->result() as $r) {}
$this->load->view('move_order_between_warehouse_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['move_order_between_warehouse_id']);
$this->db->update('porder', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>