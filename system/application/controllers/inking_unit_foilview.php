<?php

class inking_unit_foilview extends Controller {

	function inking_unit_foilview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($inking_unit_foil_id=0)
	{
		
$q = $this->db->where('id', $inking_unit_foil_id);
$q = $this->db->get('inkingunitfoil');
if ($q->num_rows() > 0) {
$data = array();
$data['inking_unit_foil_id'] = $inking_unit_foil_id;
foreach ($q->result() as $r) {}
$this->load->view('inking_unit_foil_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['inking_unit_foil_id']);
$this->db->update('inkingunitfoil', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>