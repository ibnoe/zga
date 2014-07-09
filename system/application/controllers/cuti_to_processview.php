<?php

class cuti_to_processview extends Controller {

	function cuti_to_processview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($cuti_to_process_id=0)
	{
		if ($cuti_to_process_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $cuti_to_process_id);
$this->db->select('*');
$q = $this->db->get('cutiklaim');
if ($q->num_rows() > 0) {
$data = array();
$data['cuti_to_process_id'] = $cuti_to_process_id;
foreach ($q->result() as $r) {
$data['cutiklaim__lastupdate'] = $r->lastupdate;
$data['cutiklaim__updatedby'] = $r->updatedby;
$data['cutiklaim__created'] = $r->created;
$data['cutiklaim__createdby'] = $r->createdby;}
$this->load->view('cuti_to_process_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['cutiklaim__lastupdate'];
$data['updatedby'] = $_POST['cutiklaim__updatedby'];
$data['created'] = $_POST['cutiklaim__created'];
$data['createdby'] = $_POST['cutiklaim__createdby'];
$this->db->where('id', $data['cuti_to_process_id']);
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