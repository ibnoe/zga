<?php

class journal_manualedit extends Controller {

	function journal_manualedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($journal_manual_id=0)
	{
		if ($journal_manual_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $journal_manual_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('journalmanual');
if ($q->num_rows() > 0) {
$data = array();
$data['journal_manual_id'] = $journal_manual_id;
foreach ($q->result() as $r) {
$data['journalmanual__reference'] = $r->reference;
$data['journalmanual__date'] = $r->date;
$data['journalmanual__notes'] = $r->notes;
$data['journalmanual__lastupdate'] = $r->lastupdate;
$data['journalmanual__updatedby'] = $r->updatedby;
$data['journalmanual__created'] = $r->created;
$data['journalmanual__createdby'] = $r->createdby;}
$this->load->view('journal_manual_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['journalmanual__reference']) && ($_POST['journalmanual__reference'] == "" || $_POST['journalmanual__reference'] == null))
$error .= "<span class='error'>Reference must not be empty"."</span><br>";

if (isset($_POST['journalmanual__reference'])) {$this->db->where("id !=", $_POST['journal_manual_id']);
$this->db->where('reference', $_POST['journalmanual__reference']);
$q = $this->db->get('journalmanual');
if ($q->num_rows() > 0) $error .= "<span class='error'>Reference must be unique"."</span><br>";}

if (isset($_POST['journalmanual__date']) && ($_POST['journalmanual__date'] == "" || $_POST['journalmanual__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['journalmanual__reference']))
$data['reference'] = $_POST['journalmanual__reference'];if (isset($_POST['journalmanual__date']))
$this->db->set('date', "str_to_date('".$_POST['journalmanual__date']."', '%d-%m-%Y')", false);if (isset($_POST['journalmanual__notes']))
$data['notes'] = $_POST['journalmanual__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['journal_manual_id']);
$this->db->update('journalmanual', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('journal_manualedit','journalmanual','afteredit', $_POST['journal_manual_id']);
			
			
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