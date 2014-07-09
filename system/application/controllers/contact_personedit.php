<?php

class contact_personedit extends Controller {

	function contact_personedit()
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
	
		
$q = $this->db->where('id', $contact_person_id);
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
$this->load->view('contact_person_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['contactperson__idstring']) && ($_POST['contactperson__idstring'] == "" || $_POST['contactperson__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['contactperson__idstring'])) {$this->db->where("id !=", $_POST['contact_person_id']);
$this->db->where('idstring', $_POST['contactperson__idstring']);
$q = $this->db->get('contactperson');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['contactperson__name']) && ($_POST['contactperson__name'] == "" || $_POST['contactperson__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (isset($_POST['contactperson__dob']) && ($_POST['contactperson__dob'] == "" || $_POST['contactperson__dob'] == null))
$error .= "<span class='error'>Date Of Birth must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['contactperson__idstring']))
$data['idstring'] = $_POST['contactperson__idstring'];if (isset($_POST['contactperson__name']))
$data['name'] = $_POST['contactperson__name'];if (isset($_POST['contactperson__position']))
$data['position'] = $_POST['contactperson__position'];if (isset($_POST['contactperson__address']))
$data['address'] = $_POST['contactperson__address'];if (isset($_POST['contactperson__phone']))
$data['phone'] = $_POST['contactperson__phone'];if (isset($_POST['contactperson__fax']))
$data['fax'] = $_POST['contactperson__fax'];if (isset($_POST['contactperson__mobile']))
$data['mobile'] = $_POST['contactperson__mobile'];if (isset($_POST['contactperson__email']))
$data['email'] = $_POST['contactperson__email'];if (isset($_POST['contactperson__bank']))
$data['bank'] = $_POST['contactperson__bank'];if (isset($_POST['contactperson__bankaccno']))
$data['bankaccno'] = $_POST['contactperson__bankaccno'];if (isset($_POST['contactperson__bankbranch']))
$data['bankbranch'] = $_POST['contactperson__bankbranch'];if (isset($_POST['contactperson__status']))
$data['status'] = $_POST['contactperson__status'];if (isset($_POST['contactperson__dob']))
$this->db->set('dob', "str_to_date('".$_POST['contactperson__dob']."', '%d-%m-%Y')", false);if (isset($_POST['contactperson__children']))
$data['children'] = $_POST['contactperson__children'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['contact_person_id']);
$this->db->update('contactperson', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('contact_personedit','contactperson','afteredit', $_POST['contact_person_id']);
			
			
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