<?php

class sales_returnview extends Controller {

	function sales_returnview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_id=0)
	{
		
$q = $this->db->where('id', $sales_return_id);
$q = $this->db->get('sreturn');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_id'] = $sales_return_id;
foreach ($q->result() as $r) {}
$this->load->view('sales_return_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['sales_return_id']);
$this->db->update('sreturn', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>