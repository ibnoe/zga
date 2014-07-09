<?php

class reject_manufacturingedit extends Controller {

	function reject_manufacturingedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($reject_manufacturing_id=0)
	{
		if ($reject_manufacturing_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $reject_manufacturing_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('rejectmanufacturing');
if ($q->num_rows() > 0) {
$data = array();
$data['reject_manufacturing_id'] = $reject_manufacturing_id;
foreach ($q->result() as $r) {
$data['rejectmanufacturing__idstring'] = $r->idstring;
$data['rejectmanufacturing__date'] = $r->date;
$manufacturingrejectreason_opt = array();
$manufacturingrejectreason_opt[''] = 'None';
$q = $this->db->get('manufacturingrejectreason');
foreach ($q->result() as $row) { $manufacturingrejectreason_opt[$row->id] = $row->name; }
$data['manufacturingrejectreason_opt'] = $manufacturingrejectreason_opt;
$data['rejectmanufacturing__manufacturingrejectreason_id'] = $r->manufacturingrejectreason_id;
$data['rejectmanufacturing__notes'] = $r->notes;
$data['rejectmanufacturing__lastupdate'] = $r->lastupdate;
$data['rejectmanufacturing__updatedby'] = $r->updatedby;
$data['rejectmanufacturing__created'] = $r->created;
$data['rejectmanufacturing__createdby'] = $r->createdby;}
$this->load->view('reject_manufacturing_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['rejectmanufacturing__idstring']) && ($_POST['rejectmanufacturing__idstring'] == "" || $_POST['rejectmanufacturing__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['rejectmanufacturing__idstring'])) {$this->db->where("id !=", $_POST['reject_manufacturing_id']);
$this->db->where('idstring', $_POST['rejectmanufacturing__idstring']);
$q = $this->db->get('rejectmanufacturing');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['rejectmanufacturing__date']) && ($_POST['rejectmanufacturing__date'] == "" || $_POST['rejectmanufacturing__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['rejectmanufacturing__manufacturingrejectreason_id']) || ($_POST['rejectmanufacturing__manufacturingrejectreason_id'] == "" || $_POST['rejectmanufacturing__manufacturingrejectreason_id'] == null  || $_POST['rejectmanufacturing__manufacturingrejectreason_id'] == 0))
$error .= "<span class='error'>Manufacturing Reject Reason must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rejectmanufacturing__idstring']))
$data['idstring'] = $_POST['rejectmanufacturing__idstring'];if (isset($_POST['rejectmanufacturing__date']))
$this->db->set('date', "str_to_date('".$_POST['rejectmanufacturing__date']."', '%d-%m-%Y')", false);if (isset($_POST['rejectmanufacturing__manufacturingrejectreason_id']))
$data['manufacturingrejectreason_id'] = $_POST['rejectmanufacturing__manufacturingrejectreason_id'];if (isset($_POST['rejectmanufacturing__notes']))
$data['notes'] = $_POST['rejectmanufacturing__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['reject_manufacturing_id']);
$this->db->update('rejectmanufacturing', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('reject_manufacturingedit','rejectmanufacturing','afteredit', $_POST['reject_manufacturing_id']);
			
			
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