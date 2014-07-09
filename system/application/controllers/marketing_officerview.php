<?php

class marketing_officerview extends Controller {

	function marketing_officerview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($marketing_officer_id=0)
	{
		if ($marketing_officer_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $marketing_officer_id);
$this->db->select('*');
$q = $this->db->get('marketingofficer');
if ($q->num_rows() > 0) {
$data = array();
$data['marketing_officer_id'] = $marketing_officer_id;
foreach ($q->result() as $r) {
$data['marketingofficer__idstring'] = $r->idstring;
$data['marketingofficer__name'] = $r->name;
$data['marketingofficer__notes'] = $r->notes;
$data['marketingofficer__lastupdate'] = $r->lastupdate;
$data['marketingofficer__updatedby'] = $r->updatedby;
$data['marketingofficer__created'] = $r->created;
$data['marketingofficer__createdby'] = $r->createdby;}
$this->load->view('marketing_officer_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['marketingofficer__idstring'];
$data['name'] = $_POST['marketingofficer__name'];
$data['notes'] = $_POST['marketingofficer__notes'];
$data['lastupdate'] = $_POST['marketingofficer__lastupdate'];
$data['updatedby'] = $_POST['marketingofficer__updatedby'];
$data['created'] = $_POST['marketingofficer__created'];
$data['createdby'] = $_POST['marketingofficer__createdby'];
$this->db->where('id', $data['marketing_officer_id']);
$this->db->update('marketingofficer', $data);
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