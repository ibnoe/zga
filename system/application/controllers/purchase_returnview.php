<?php

class purchase_returnview extends Controller {

	function purchase_returnview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_id=0)
	{
		
$q = $this->db->where('id', $purchase_return_id);
$q = $this->db->get('preturn');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_id'] = $purchase_return_id;
foreach ($q->result() as $r) {}
$this->load->view('purchase_return_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['purchase_return_id']);
$this->db->update('preturn', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>