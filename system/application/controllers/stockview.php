<?php

class stockview extends Controller {

	function stockview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($stock_id=0)
	{
		if ($stock_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $stock_id);
$this->db->select('*');
$q = $this->db->get('stock');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_id'] = $stock_id;
foreach ($q->result() as $r) {}
$this->load->view('stock_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $data['stock_id']);
$this->db->update('stock', $data);
			validationonserver();
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
			}
			else
			{
				echo "<span style='background-color:red'>   </span> ".$error;
			}
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>