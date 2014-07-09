<?php

class contact_personadd extends Controller {

	function contact_personadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['customer_id'] = $id;
$data['contactperson__idstring'] = '';$this->load->library('generallib');
$data['contactperson__idstring'] = $this->generallib->genId('Contact Person');
$data['contactperson__name'] = '';
$data['contactperson__position'] = '';
$data['contactperson__address'] = '';
$data['contactperson__phone'] = '';
$data['contactperson__fax'] = '';
$data['contactperson__mobile'] = '';
$data['contactperson__email'] = '';
$data['contactperson__bank'] = '';
$data['contactperson__bankaccno'] = '';
$data['contactperson__bankbranch'] = '';
$data['contactperson__status'] = '';
$data['contactperson__dob'] = '';
$data['contactperson__children'] = '';
$data['contactperson__lastupdate'] = '';
$data['contactperson__updatedby'] = '';
$data['contactperson__created'] = '';
$data['contactperson__createdby'] = '';
$customer = array();
$this->db->where('id', $id);
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
$customer = $q->row_array();
$data['contactperson__idstring'] = $customer['idstring'];
$data['contactperson__address'] = $customer['address'];
$data['contactperson__phone'] = $customer['phone'];
$data['contactperson__fax'] = $customer['fax'];
$data['contactperson__email'] = $customer['email'];
$data['contactperson__status'] = $customer['status'];
$data['contactperson__lastupdate'] = $customer['lastupdate'];
$data['contactperson__updatedby'] = $customer['updatedby'];
$data['contactperson__created'] = $customer['created'];
$data['contactperson__createdby'] = $customer['createdby'];
		

		$this->load->view('contact_person_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['contactperson__idstring']) && ($_POST['contactperson__idstring'] == "" || $_POST['contactperson__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['contactperson__idstring'])) {
$this->db->where('idstring', $_POST['contactperson__idstring']);
$q = $this->db->get('contactperson');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['contactperson__name']) && ($_POST['contactperson__name'] == "" || $_POST['contactperson__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (isset($_POST['contactperson__dob']) && ($_POST['contactperson__dob'] == "" || $_POST['contactperson__dob'] == null))
$error .= "<span class='error'>Date Of Birth must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['customer_id'] = $_POST['customer_id'];if (isset($_POST['contactperson__idstring']))
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
$this->db->insert('contactperson', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$contactperson_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('contact_personadd','contactperson','aftersave', $contactperson_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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