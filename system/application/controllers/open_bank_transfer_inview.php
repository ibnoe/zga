<?php

class open_bank_transfer_inview extends Controller {

	function open_bank_transfer_inview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_bank_transfer_in_id=0)
	{
		if ($open_bank_transfer_in_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_bank_transfer_in_id);
$this->db->select('*');
$q = $this->db->get('banktransfermasuk');
if ($q->num_rows() > 0) {
$data = array();
$data['open_bank_transfer_in_id'] = $open_bank_transfer_in_id;
foreach ($q->result() as $r) {
$data['banktransfermasuk__lastupdate'] = $r->lastupdate;
$data['banktransfermasuk__updatedby'] = $r->updatedby;
$data['banktransfermasuk__created'] = $r->created;
$data['banktransfermasuk__createdby'] = $r->createdby;}
$this->load->view('open_bank_transfer_in_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['banktransfermasuk__lastupdate'];
$data['updatedby'] = $_POST['banktransfermasuk__updatedby'];
$data['created'] = $_POST['banktransfermasuk__created'];
$data['createdby'] = $_POST['banktransfermasuk__createdby'];
$this->db->where('id', $data['open_bank_transfer_in_id']);
$this->db->update('banktransfermasuk', $data);
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