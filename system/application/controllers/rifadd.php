<?php

class rifadd extends Controller {

	function rifadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['rcn__norif'] = '';$this->load->library('generallib');
$data['rcn__norif'] = $this->generallib->genId('RIF');
$data['rcn__incomingrolldate'] = '';
$data['rcn__incomingrolltime'] = '';
$data['rcn__identificationdate'] = '';
$data['rcn__identificationtime'] = '';
$data['rcn__press'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['rcn__customer_id'] = '';
$data['rcn__nodiss'] = '';$this->load->library('generallib');
$data['rcn__nodiss'] = $this->generallib->genId('RIF');
$data['rcn__lastupdate'] = '';
$data['rcn__updatedby'] = '';
$data['rcn__created'] = '';
$data['rcn__createdby'] = '';
		

		$this->load->view('rif_add_form', $data);
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

if (isset($_POST['rcn__incomingrolldate']) && ($_POST['rcn__incomingrolldate'] == "" || $_POST['rcn__incomingrolldate'] == null))
$error .= "<span class='error'>Date of Incoming Roll must not be empty"."</span><br>";

if (isset($_POST['rcn__identificationdate']) && ($_POST['rcn__identificationdate'] == "" || $_POST['rcn__identificationdate'] == null))
$error .= "<span class='error'>Date of Identification must not be empty"."</span><br>";

if (!isset($_POST['rcn__customer_id']) || ($_POST['rcn__customer_id'] == "" || $_POST['rcn__customer_id'] == null  || $_POST['rcn__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (isset($_POST['rcn__nodiss']) && ($_POST['rcn__nodiss'] == "" || $_POST['rcn__nodiss'] == null))
$error .= "<span class='error'>No Diss must not be empty"."</span><br>";

if (isset($_POST['rcn__nodiss'])) {
$this->db->where('nodiss', $_POST['rcn__nodiss']);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Diss must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rcn__norif']))
$data['norif'] = $_POST['rcn__norif'];if (isset($_POST['rcn__incomingrolldate']))
$this->db->set('incomingrolldate', "str_to_date('".$_POST['rcn__incomingrolldate']."', '%d-%m-%Y')", false);if (isset($_POST['rcn__incomingrolltime']))
$data['incomingrolltime'] = $_POST['rcn__incomingrolltime'];if (isset($_POST['rcn__identificationdate']))
$this->db->set('identificationdate', "str_to_date('".$_POST['rcn__identificationdate']."', '%d-%m-%Y')", false);if (isset($_POST['rcn__identificationtime']))
$data['identificationtime'] = $_POST['rcn__identificationtime'];if (isset($_POST['rcn__press']))
$data['press'] = $_POST['rcn__press'];if (isset($_POST['rcn__customer_id']))
$data['customer_id'] = $_POST['rcn__customer_id'];if (isset($_POST['rcn__nodiss']))
$data['nodiss'] = $_POST['rcn__nodiss'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('rcn', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$rcn_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('rifadd','rcn','aftersave', $rcn_id);
			
		
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