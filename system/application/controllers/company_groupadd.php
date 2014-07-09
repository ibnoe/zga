<?php

class company_groupadd extends Controller {

	function company_groupadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['customergroup__idstring'] = '';$this->load->library('generallib');
$data['customergroup__idstring'] = $this->generallib->genId('Company Group');
$data['customergroup__name'] = '';
$data['customergroup__notes'] = '';
$data['customergroup__lastupdate'] = '';
$data['customergroup__updatedby'] = '';
$data['customergroup__created'] = '';
$data['customergroup__createdby'] = '';
		

		$this->load->view('company_group_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['customergroup__idstring']) && ($_POST['customergroup__idstring'] == "" || $_POST['customergroup__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['customergroup__idstring'])) {
$this->db->where('idstring', $_POST['customergroup__idstring']);
$q = $this->db->get('customergroup');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['customergroup__name']) && ($_POST['customergroup__name'] == "" || $_POST['customergroup__name'] == null))
$error .= "<span class='error'>Group Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['customergroup__idstring']))
$data['idstring'] = $_POST['customergroup__idstring'];if (isset($_POST['customergroup__name']))
$data['name'] = $_POST['customergroup__name'];if (isset($_POST['customergroup__notes']))
$data['notes'] = $_POST['customergroup__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('customergroup', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$customergroup_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('company_groupadd','customergroup','aftersave', $customergroup_id);
			
		
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