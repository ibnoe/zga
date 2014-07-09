<?php

class under_packing_folexview extends Controller {

	function under_packing_folexview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($under_packing_folex_id=0)
	{
		
$q = $this->db->where('id', $under_packing_folex_id);
$q = $this->db->get('itemzengraunderpackingfolex');
if ($q->num_rows() > 0) {
$data = array();
$data['under_packing_folex_id'] = $under_packing_folex_id;
foreach ($q->result() as $r) {}
$this->load->view('under_packing_folex_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['under_packing_folex_id']);
$this->db->update('itemzengraunderpackingfolex', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>