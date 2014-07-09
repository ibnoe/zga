<?php

class giro_out_clearanceedit extends Controller {

	function giro_out_clearanceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_out_clearance_id=0)
	{
		if ($giro_out_clearance_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $giro_out_clearance_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('girooutclearance');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_out_clearance_id'] = $giro_out_clearance_id;
foreach ($q->result() as $r) {
$data['girooutclearance__date'] = $r->date;
$data['girooutclearance__idstring'] = $r->idstring;
$data['girooutclearance__notes'] = $r->notes;
$data['girooutclearance__lastupdate'] = $r->lastupdate;
$data['girooutclearance__updatedby'] = $r->updatedby;
$data['girooutclearance__created'] = $r->created;
$data['girooutclearance__createdby'] = $r->createdby;}
$this->load->view('giro_out_clearance_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['girooutclearance__date']) && ($_POST['girooutclearance__date'] == "" || $_POST['girooutclearance__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['girooutclearance__idstring']) && ($_POST['girooutclearance__idstring'] == "" || $_POST['girooutclearance__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['girooutclearance__idstring'])) {$this->db->where("id !=", $_POST['giro_out_clearance_id']);
$this->db->where('idstring', $_POST['girooutclearance__idstring']);
$q = $this->db->get('girooutclearance');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['girooutclearance__date']))
$this->db->set('date', "str_to_date('".$_POST['girooutclearance__date']."', '%d-%m-%Y')", false);if (isset($_POST['girooutclearance__idstring']))
$data['idstring'] = $_POST['girooutclearance__idstring'];if (isset($_POST['girooutclearance__notes']))
$data['notes'] = $_POST['girooutclearance__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['giro_out_clearance_id']);
$this->db->update('girooutclearance', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_out_clearanceedit','girooutclearance','afteredit', $_POST['giro_out_clearance_id']);
			
			
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