<?php

class cuti_approvalview extends Controller {

	function cuti_approvalview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($cuti_approval_id=0)
	{
		if ($cuti_approval_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $cuti_approval_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('cutiklaim');
if ($q->num_rows() > 0) {
$data = array();
$data['cuti_approval_id'] = $cuti_approval_id;
foreach ($q->result() as $r) {
$data['cutiklaim__date'] = $r->date;
$data['cutiklaim__totalcutiklaimed'] = $r->totalcutiklaimed;
$data['cutiklaim__notes'] = $r->notes;
$data['cutiklaim__status'] = $r->status;
$data['cutiklaim__lastupdate'] = $r->lastupdate;
$data['cutiklaim__updatedby'] = $r->updatedby;
$data['cutiklaim__created'] = $r->created;
$data['cutiklaim__createdby'] = $r->createdby;}
$this->load->view('cuti_approval_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['cutiklaim__date'];
$data['totalcutiklaimed'] = $_POST['cutiklaim__totalcutiklaimed'];
$data['notes'] = $_POST['cutiklaim__notes'];
$data['status'] = $_POST['cutiklaim__status'];
$data['lastupdate'] = $_POST['cutiklaim__lastupdate'];
$data['updatedby'] = $_POST['cutiklaim__updatedby'];
$data['created'] = $_POST['cutiklaim__created'];
$data['createdby'] = $_POST['cutiklaim__createdby'];
$this->db->where('id', $data['cuti_approval_id']);
$this->db->update('cutiklaim', $data);
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