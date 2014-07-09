<?php

class rcnedit extends Controller {

	function rcnedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($rcn_id=0)
	{
		if ($rcn_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $rcn_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(datercn, "%d-%m-%Y") as datercn', false);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) {
$data = array();
$data['rcn_id'] = $rcn_id;
foreach ($q->result() as $r) {
$data['rcn__norif'] = $r->norif;
$data['rcn__norcn'] = $r->norcn;
$data['rcn__customerponumber'] = $r->customerponumber;
$data['rcn__datercn'] = $r->datercn;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['rcn__customer_id'] = $r->customer_id;
$data['rcn__reqtorecover'] = $r->reqtorecover;
$data['rcn__reqcoretoreturn'] = $r->reqcoretoreturn;
$data['rcn__reqreturnunused'] = $r->reqreturnunused;
$data['rcn__reqreturnfaulty'] = $r->reqreturnfaulty;
$data['rcn__reqothers'] = $r->reqothers;
$data['rcn__notes'] = $r->notes;
$data['rcn__status'] = $r->status;
$data['rcn__lastupdate'] = $r->lastupdate;
$data['rcn__updatedby'] = $r->updatedby;
$data['rcn__created'] = $r->created;
$data['rcn__createdby'] = $r->createdby;}
$this->load->view('rcn_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['rcn__norif']) && ($_POST['rcn__norif'] == "" || $_POST['rcn__norif'] == null))
$error .= "<span class='error'>No RIF must not be empty"."</span><br>";

if (isset($_POST['rcn__norif'])) {$this->db->where("id !=", $_POST['rcn_id']);
$this->db->where('norif', $_POST['rcn__norif']);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) $error .= "<span class='error'>No RIF must be unique"."</span><br>";}

if (isset($_POST['rcn__norcn']) && ($_POST['rcn__norcn'] == "" || $_POST['rcn__norcn'] == null))
$error .= "<span class='error'>No RCN must not be empty"."</span><br>";

if (isset($_POST['rcn__norcn'])) {$this->db->where("id !=", $_POST['rcn_id']);
$this->db->where('norcn', $_POST['rcn__norcn']);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) $error .= "<span class='error'>No RCN must be unique"."</span><br>";}

if (isset($_POST['rcn__customerponumber']) && ($_POST['rcn__customerponumber'] == "" || $_POST['rcn__customerponumber'] == null))
$error .= "<span class='error'>No PO must not be empty"."</span><br>";

if (isset($_POST['rcn__customerponumber'])) {$this->db->where("id !=", $_POST['rcn_id']);
$this->db->where('customerponumber', $_POST['rcn__customerponumber']);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) $error .= "<span class='error'>No PO must be unique"."</span><br>";}

if (isset($_POST['rcn__datercn']) && ($_POST['rcn__datercn'] == "" || $_POST['rcn__datercn'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['rcn__customer_id']) || ($_POST['rcn__customer_id'] == "" || $_POST['rcn__customer_id'] == null  || $_POST['rcn__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rcn__norif']))
$data['norif'] = $_POST['rcn__norif'];if (isset($_POST['rcn__norcn']))
$data['norcn'] = $_POST['rcn__norcn'];if (isset($_POST['rcn__customerponumber']))
$data['customerponumber'] = $_POST['rcn__customerponumber'];if (isset($_POST['rcn__datercn']))
$this->db->set('datercn', "str_to_date('".$_POST['rcn__datercn']."', '%d-%m-%Y')", false);if (isset($_POST['rcn__customer_id']))
$data['customer_id'] = $_POST['rcn__customer_id'];
if (isset($_POST['rcn__reqtorecover']))
$data['reqtorecover'] = 1;
else
$data['reqtorecover'] = 0;
if (isset($_POST['rcn__reqcoretoreturn']))
$data['reqcoretoreturn'] = 1;
else
$data['reqcoretoreturn'] = 0;
if (isset($_POST['rcn__reqreturnunused']))
$data['reqreturnunused'] = 1;
else
$data['reqreturnunused'] = 0;
if (isset($_POST['rcn__reqreturnfaulty']))
$data['reqreturnfaulty'] = 1;
else
$data['reqreturnfaulty'] = 0;
if (isset($_POST['rcn__reqothers']))
$data['reqothers'] = 1;
else
$data['reqothers'] = 0;if (isset($_POST['rcn__notes']))
$data['notes'] = $_POST['rcn__notes'];if (isset($_POST['rcn__status']))
$data['status'] = $_POST['rcn__status'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['rcn_id']);
$this->db->update('rcn', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('rcnedit','rcn','afteredit', $_POST['rcn_id']);
			
			
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