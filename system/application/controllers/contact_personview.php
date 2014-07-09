<?php

class contact_personview extends Controller {

	function contact_personview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($contact_person_id=0)
	{
		if ($contact_person_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $contact_person_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(dob, "%d-%m-%Y") as dob', false);
$q = $this->db->get('contactperson');
if ($q->num_rows() > 0) {
$data = array();
$data['contact_person_id'] = $contact_person_id;
foreach ($q->result() as $r) {
$data['contactperson__idstring'] = $r->idstring;
$data['contactperson__name'] = $r->name;
$data['contactperson__position'] = $r->position;
$data['contactperson__address'] = $r->address;
$data['contactperson__phone'] = $r->phone;
$data['contactperson__fax'] = $r->fax;
$data['contactperson__mobile'] = $r->mobile;
$data['contactperson__email'] = $r->email;
$data['contactperson__bank'] = $r->bank;
$data['contactperson__bankaccno'] = $r->bankaccno;
$data['contactperson__bankbranch'] = $r->bankbranch;
$data['contactperson__status'] = $r->status;
$data['contactperson__dob'] = $r->dob;
$data['contactperson__children'] = $r->children;
$data['contactperson__lastupdate'] = $r->lastupdate;
$data['contactperson__updatedby'] = $r->updatedby;
$data['contactperson__created'] = $r->created;
$data['contactperson__createdby'] = $r->createdby;}
$this->load->view('contact_person_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['contactperson__idstring'];
$data['name'] = $_POST['contactperson__name'];
$data['position'] = $_POST['contactperson__position'];
$data['address'] = $_POST['contactperson__address'];
$data['phone'] = $_POST['contactperson__phone'];
$data['fax'] = $_POST['contactperson__fax'];
$data['mobile'] = $_POST['contactperson__mobile'];
$data['email'] = $_POST['contactperson__email'];
$data['bank'] = $_POST['contactperson__bank'];
$data['bankaccno'] = $_POST['contactperson__bankaccno'];
$data['bankbranch'] = $_POST['contactperson__bankbranch'];
$data['status'] = $_POST['contactperson__status'];
$data['dob'] = $_POST['contactperson__dob'];
$data['children'] = $_POST['contactperson__children'];
$data['lastupdate'] = $_POST['contactperson__lastupdate'];
$data['updatedby'] = $_POST['contactperson__updatedby'];
$data['created'] = $_POST['contactperson__created'];
$data['createdby'] = $_POST['contactperson__createdby'];
$this->db->where('id', $data['contact_person_id']);
$this->db->update('contactperson', $data);
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