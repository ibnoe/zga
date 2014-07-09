<?php

class filter_vacuumview extends Controller {

	function filter_vacuumview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($filter_vacuum_id=0)
	{
		
$q = $this->db->where('id', $filter_vacuum_id);
$q = $this->db->get('filtervacuum');
if ($q->num_rows() > 0) {
$data = array();
$data['filter_vacuum_id'] = $filter_vacuum_id;
foreach ($q->result() as $r) {}
$this->load->view('filter_vacuum_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['filter_vacuum_id']);
$this->db->update('filtervacuum', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>