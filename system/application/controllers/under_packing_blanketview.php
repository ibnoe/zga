<?php

class under_packing_blanketview extends Controller {

	function under_packing_blanketview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($under_packing_blanket_id=0)
	{
		
$q = $this->db->where('id', $under_packing_blanket_id);
$q = $this->db->get('underpackingblanket');
if ($q->num_rows() > 0) {
$data = array();
$data['under_packing_blanket_id'] = $under_packing_blanket_id;
foreach ($q->result() as $r) {}
$this->load->view('under_packing_blanket_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['under_packing_blanket_id']);
$this->db->update('underpackingblanket', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>