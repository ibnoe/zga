<?php

class composite_canview extends Controller {

	function composite_canview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($composite_can_id=0)
	{
		
$q = $this->db->where('id', $composite_can_id);
$q = $this->db->get('composite');
if ($q->num_rows() > 0) {
$data = array();
$data['composite_can_id'] = $composite_can_id;
foreach ($q->result() as $r) {}
$this->load->view('composite_can_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['composite_can_id']);
$this->db->update('composite', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>