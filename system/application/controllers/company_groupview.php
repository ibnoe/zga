<?php

class company_groupview extends Controller {

	function company_groupview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($company_group_id=0)
	{
		if ($company_group_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $company_group_id);
$this->db->select('*');
$q = $this->db->get('customergroup');
if ($q->num_rows() > 0) {
$data = array();
$data['company_group_id'] = $company_group_id;
foreach ($q->result() as $r) {
$data['customergroup__idstring'] = $r->idstring;
$data['customergroup__name'] = $r->name;
$data['customergroup__notes'] = $r->notes;
$data['customergroup__lastupdate'] = $r->lastupdate;
$data['customergroup__updatedby'] = $r->updatedby;
$data['customergroup__created'] = $r->created;
$data['customergroup__createdby'] = $r->createdby;}
$this->load->view('company_group_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['customergroup__idstring'];
$data['name'] = $_POST['customergroup__name'];
$data['notes'] = $_POST['customergroup__notes'];
$data['lastupdate'] = $_POST['customergroup__lastupdate'];
$data['updatedby'] = $_POST['customergroup__updatedby'];
$data['created'] = $_POST['customergroup__created'];
$data['createdby'] = $_POST['customergroup__createdby'];
$this->db->where('id', $data['company_group_id']);
$this->db->update('customergroup', $data);
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