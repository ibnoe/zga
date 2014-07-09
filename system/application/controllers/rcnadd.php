<?php

class rcnadd extends Controller {

	function rcnadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['rcn__norif'] = '';$this->load->library('generallib');
$data['rcn__norif'] = $this->generallib->genId('RCN');
$data['rcn__norcn'] = '';$this->load->library('generallib');
$data['rcn__norcn'] = $this->generallib->genId('RCN');
$data['rcn__customerponumber'] = '';$this->load->library('generallib');
$data['rcn__customerponumber'] = $this->generallib->genId('RCN');
$data['rcn__datercn'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['rcn__customer_id'] = '';
$data['rcn__reqtorecover'] = '';
$data['rcn__reqcoretoreturn'] = '';
$data['rcn__reqreturnunused'] = '';
$data['rcn__reqreturnfaulty'] = '';
$data['rcn__reqothers'] = '';
$data['rcn__notes'] = '';
$data['rcn__status'] = '';
$data['rcn__lastupdate'] = '';
$data['rcn__updatedby'] = '';
$data['rcn__created'] = '';
$data['rcn__createdby'] = '';
		

		$this->load->view('rcn_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['rcn__norif']) && ($_POST['rcn__norif'] == "" || $_POST['rcn__norif'] == null))
$error .= "<span class='error'>No RIF must not be empty"."</span><br>";

if (isset($_POST['rcn__norif'])) {
$this->db->where('norif', $_POST['rcn__norif']);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) $error .= "<span class='error'>No RIF must be unique"."</span><br>";}

if (isset($_POST['rcn__norcn']) && ($_POST['rcn__norcn'] == "" || $_POST['rcn__norcn'] == null))
$error .= "<span class='error'>No RCN must not be empty"."</span><br>";

if (isset($_POST['rcn__norcn'])) {
$this->db->where('norcn', $_POST['rcn__norcn']);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) $error .= "<span class='error'>No RCN must be unique"."</span><br>";}

if (isset($_POST['rcn__customerponumber']) && ($_POST['rcn__customerponumber'] == "" || $_POST['rcn__customerponumber'] == null))
$error .= "<span class='error'>No PO must not be empty"."</span><br>";

if (isset($_POST['rcn__customerponumber'])) {
$this->db->where('customerponumber', $_POST['rcn__customerponumber']);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) $error .= "<span class='error'>No PO must be unique"."</span><br>";}

if (isset($_POST['rcn__datercn']) && ($_POST['rcn__datercn'] == "" || $_POST['rcn__datercn'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['rcn__customer_id']) || ($_POST['rcn__customer_id'] == "" || $_POST['rcn__customer_id'] == null  || $_POST['rcn__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rcn__norif']))
$data['norif'] = $_POST['rcn__norif'];if (isset($_POST['rcn__norcn']))
$data['norcn'] = $_POST['rcn__norcn'];if (isset($_POST['rcn__customerponumber']))
$data['customerponumber'] = $_POST['rcn__customerponumber'];if (isset($_POST['rcn__datercn']))
$this->db->set('datercn', "str_to_date('".$_POST['rcn__datercn']."', '%d-%m-%Y')", false);if (isset($_POST['rcn__customer_id']))
$data['customer_id'] = $_POST['rcn__customer_id'];if (isset($_POST['rcn__reqtorecover']))
$data['reqtorecover'] = $_POST['rcn__reqtorecover'];
else $data['reqtorecover'] = false;if (isset($_POST['rcn__reqcoretoreturn']))
$data['reqcoretoreturn'] = $_POST['rcn__reqcoretoreturn'];
else $data['reqcoretoreturn'] = false;if (isset($_POST['rcn__reqreturnunused']))
$data['reqreturnunused'] = $_POST['rcn__reqreturnunused'];
else $data['reqreturnunused'] = false;if (isset($_POST['rcn__reqreturnfaulty']))
$data['reqreturnfaulty'] = $_POST['rcn__reqreturnfaulty'];
else $data['reqreturnfaulty'] = false;if (isset($_POST['rcn__reqothers']))
$data['reqothers'] = $_POST['rcn__reqothers'];
else $data['reqothers'] = false;if (isset($_POST['rcn__notes']))
$data['notes'] = $_POST['rcn__notes'];if (isset($_POST['rcn__status']))
$data['status'] = $_POST['rcn__status'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('rcn', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$rcn_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('rcnadd','rcn','aftersave', $rcn_id);
			
		
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