<?php

class open_bank_transfer_outview extends Controller {

	function open_bank_transfer_outview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_bank_transfer_out_id=0)
	{
		if ($open_bank_transfer_out_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $open_bank_transfer_out_id);
$this->db->select('*');
$q = $this->db->get('banktransferkeluar');
if ($q->num_rows() > 0) {
$data = array();
$data['open_bank_transfer_out_id'] = $open_bank_transfer_out_id;
foreach ($q->result() as $r) {
$data['banktransferkeluar__lastupdate'] = $r->lastupdate;
$data['banktransferkeluar__updatedby'] = $r->updatedby;
$data['banktransferkeluar__created'] = $r->created;
$data['banktransferkeluar__createdby'] = $r->createdby;}
$this->load->view('open_bank_transfer_out_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['banktransferkeluar__lastupdate'];
$data['updatedby'] = $_POST['banktransferkeluar__updatedby'];
$data['created'] = $_POST['banktransferkeluar__created'];
$data['createdby'] = $_POST['banktransferkeluar__createdby'];
$this->db->where('id', $data['open_bank_transfer_out_id']);
$this->db->update('banktransferkeluar', $data);
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