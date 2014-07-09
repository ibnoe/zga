<?php

class open_purchase_orderview extends Controller {

	function open_purchase_orderview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_purchase_order_id=0)
	{
		
$q = $this->db->where('id', $open_purchase_order_id);
$q = $this->db->get('porder');
if ($q->num_rows() > 0) {
$data = array();
$data['open_purchase_order_id'] = $open_purchase_order_id;
foreach ($q->result() as $r) {}
$this->load->view('open_purchase_order_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['open_purchase_order_id']);
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