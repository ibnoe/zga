<?php

class company_groupedit extends Controller {

	function company_groupedit()
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
	
		
$q = $this->db->where('id', $company_group_id);
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
$this->load->view('company_group_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['customergroup__idstring']) && ($_POST['customergroup__idstring'] == "" || $_POST['customergroup__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['customergroup__idstring'])) {$this->db->where("id !=", $_POST['company_group_id']);
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
$this->db->where('id', $_POST['company_group_id']);
$this->db->update('customergroup', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('company_groupedit','customergroup','afteredit', $_POST['company_group_id']);
			
			
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