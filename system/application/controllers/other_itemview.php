<?php

class other_itemview extends Controller {

	function other_itemview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($other_item_id=0)
	{
		
$q = $this->db->where('id', $other_item_id);
$q = $this->db->get('item');
if ($q->num_rows() > 0) {
$data = array();
$data['other_item_id'] = $other_item_id;
foreach ($q->result() as $r) {}
$this->load->view('other_item_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['other_item_id']);
$this->db->update('item', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>