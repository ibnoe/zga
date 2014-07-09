<?php

class giro_in_clearanceedit extends Controller {

	function giro_in_clearanceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_in_clearance_id=0)
	{
		if ($giro_in_clearance_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $giro_in_clearance_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('giroinclearance');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_in_clearance_id'] = $giro_in_clearance_id;
foreach ($q->result() as $r) {
$data['giroinclearance__date'] = $r->date;
$data['giroinclearance__idstring'] = $r->idstring;
$data['giroinclearance__notes'] = $r->notes;
$data['giroinclearance__lastupdate'] = $r->lastupdate;
$data['giroinclearance__updatedby'] = $r->updatedby;
$data['giroinclearance__created'] = $r->created;
$data['giroinclearance__createdby'] = $r->createdby;}
$this->load->view('giro_in_clearance_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['giroinclearance__date']) && ($_POST['giroinclearance__date'] == "" || $_POST['giroinclearance__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['giroinclearance__idstring']) && ($_POST['giroinclearance__idstring'] == "" || $_POST['giroinclearance__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['giroinclearance__idstring'])) {$this->db->where("id !=", $_POST['giro_in_clearance_id']);
$this->db->where('idstring', $_POST['giroinclearance__idstring']);
$q = $this->db->get('giroinclearance');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['giroinclearance__date']))
$this->db->set('date', "str_to_date('".$_POST['giroinclearance__date']."', '%d-%m-%Y')", false);if (isset($_POST['giroinclearance__idstring']))
$data['idstring'] = $_POST['giroinclearance__idstring'];if (isset($_POST['giroinclearance__notes']))
$data['notes'] = $_POST['giroinclearance__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['giro_in_clearance_id']);
$this->db->update('giroinclearance', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_in_clearanceedit','giroinclearance','afteredit', $_POST['giro_in_clearance_id']);
			
			
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