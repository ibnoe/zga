<?php

class marketing_officeredit extends Controller {

	function marketing_officeredit()
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
	
		
$q = $this->db->where('id', $marketing_officer_id);
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
$this->load->view('marketing_officer_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['marketingofficer__idstring']) && ($_POST['marketingofficer__idstring'] == "" || $_POST['marketingofficer__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['marketingofficer__idstring'])) {$this->db->where("id !=", $_POST['marketing_officer_id']);
$this->db->where('idstring', $_POST['marketingofficer__idstring']);
$q = $this->db->get('marketingofficer');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['marketingofficer__name']) && ($_POST['marketingofficer__name'] == "" || $_POST['marketingofficer__name'] == null))
$error .= "<span class='error'>Officer Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['marketingofficer__idstring']))
$data['idstring'] = $_POST['marketingofficer__idstring'];if (isset($_POST['marketingofficer__name']))
$data['name'] = $_POST['marketingofficer__name'];if (isset($_POST['marketingofficer__notes']))
$data['notes'] = $_POST['marketingofficer__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['marketing_officer_id']);
$this->db->update('marketingofficer', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('marketing_officeredit','marketingofficer','afteredit', $_POST['marketing_officer_id']);
			
			
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