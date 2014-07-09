<?php

class locationview extends Controller {

	function locationview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($location_id=0)
	{
		
$q = $this->db->where('id', $location_id);
$q = $this->db->get('contact');
if ($q->num_rows() > 0) {
$data = array();
$data['location_id'] = $location_id;
foreach ($q->result() as $r) {}
$this->load->view('location_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['location_id']);
$this->db->update('contact', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>