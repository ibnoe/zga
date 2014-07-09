<?php

class stockedit extends Controller {

	function stockedit()
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
	
		
$q = $this->db->where('id', $stock_id);
$this->db->select('*');
$q = $this->db->get('stock');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_id'] = $stock_id;
foreach ($q->result() as $r) {}
$this->load->view('stock_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();
$this->db->where('id', $_POST['stock_id']);
$this->db->update('stock', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stockedit','stock','afteredit', $_POST['stock_id']);
			
			
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