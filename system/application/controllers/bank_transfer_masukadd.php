<?php

class bank_transfer_masukadd extends Controller {

	function bank_transfer_masukadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['banktransfermasuk__idstring'] = '';$this->load->library('generallib');
$data['banktransfermasuk__idstring'] = $this->generallib->genId('Bank Transfer Masuk');
$data['banktransfermasuk__date'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['banktransfermasuk__currency_id'] = '';
$data['banktransfermasuk__amount'] = '';
$data['banktransfermasuk__notes'] = '';
$data['banktransfermasuk__transferedflag'] = '';
$data['banktransfermasuk__lastupdate'] = '';
$data['banktransfermasuk__updatedby'] = '';
$data['banktransfermasuk__created'] = '';
$data['banktransfermasuk__createdby'] = '';
		

		$this->load->view('bank_transfer_masuk_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['banktransfermasuk__idstring']) && ($_POST['banktransfermasuk__idstring'] == "" || $_POST['banktransfermasuk__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['banktransfermasuk__idstring'])) {
$this->db->where('idstring', $_POST['banktransfermasuk__idstring']);
$q = $this->db->get('banktransfermasuk');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['banktransfermasuk__date']) && ($_POST['banktransfermasuk__date'] == "" || $_POST['banktransfermasuk__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['banktransfermasuk__currency_id']) || ($_POST['banktransfermasuk__currency_id'] == "" || $_POST['banktransfermasuk__currency_id'] == null  || $_POST['banktransfermasuk__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['banktransfermasuk__idstring']))
$data['idstring'] = $_POST['banktransfermasuk__idstring'];if (isset($_POST['banktransfermasuk__date']))
$this->db->set('date', "str_to_date('".$_POST['banktransfermasuk__date']."', '%d-%m-%Y')", false);if (isset($_POST['banktransfermasuk__currency_id']))
$data['currency_id'] = $_POST['banktransfermasuk__currency_id'];if (isset($_POST['banktransfermasuk__amount']))
$data['amount'] = $_POST['banktransfermasuk__amount'];if (isset($_POST['banktransfermasuk__notes']))
$data['notes'] = $_POST['banktransfermasuk__notes'];if (isset($_POST['banktransfermasuk__transferedflag']))
$data['transferedflag'] = $_POST['banktransfermasuk__transferedflag'];
else $data['transferedflag'] = false;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('banktransfermasuk', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$banktransfermasuk_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('bank_transfer_masukadd','banktransfermasuk','aftersave', $banktransfermasuk_id);
			
		
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