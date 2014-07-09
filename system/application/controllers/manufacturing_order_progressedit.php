<?php

class manufacturing_order_progressedit extends Controller {

	function manufacturing_order_progressedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_order_progress_id=0)
	{
		if ($manufacturing_order_progress_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $manufacturing_order_progress_id);
$this->db->select('*');
$q = $this->db->get('manufacturingorder');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_order_progress_id'] = $manufacturing_order_progress_id;
foreach ($q->result() as $r) {
$data['manufacturingorder__lastupdate'] = $r->lastupdate;
$data['manufacturingorder__updatedby'] = $r->updatedby;
$data['manufacturingorder__created'] = $r->created;
$data['manufacturingorder__createdby'] = $r->createdby;}
$this->load->view('manufacturing_order_progress_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['manufacturing_order_progress_id']);
$this->db->update('manufacturingorder', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_order_progressedit','manufacturingorder','afteredit', $_POST['manufacturing_order_progress_id']);
			
			
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