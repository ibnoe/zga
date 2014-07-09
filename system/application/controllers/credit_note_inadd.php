<?php

class credit_note_inadd extends Controller {

	function credit_note_inadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['creditnotein__creditnoteinid'] = '';$this->load->library('generallib');
$data['creditnotein__creditnoteinid'] = $this->generallib->genId('Credit Note In');
$data['creditnotein__date'] = '';
$data['creditnotein__expirydate'] = '';
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['creditnotein__supplier_id'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['creditnotein__coa_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['creditnotein__currency_id'] = '';
$data['creditnotein__amount'] = '';
$data['creditnotein__notes'] = '';
$data['creditnotein__usedflag'] = '0';
$data['creditnotein__lastupdate'] = '';
$data['creditnotein__updatedby'] = '';
$data['creditnotein__created'] = '';
$data['creditnotein__createdby'] = '';
		

		$this->load->view('credit_note_in_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['creditnotein__creditnoteinid']) && ($_POST['creditnotein__creditnoteinid'] == "" || $_POST['creditnotein__creditnoteinid'] == null))
$error .= "<span class='error'>CN ID must not be empty"."</span><br>";

if (isset($_POST['creditnotein__creditnoteinid'])) {
$this->db->where('creditnoteinid', $_POST['creditnotein__creditnoteinid']);
$q = $this->db->get('creditnotein');
if ($q->num_rows() > 0) $error .= "<span class='error'>CN ID must be unique"."</span><br>";}

if (isset($_POST['creditnotein__date']) && ($_POST['creditnotein__date'] == "" || $_POST['creditnotein__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['creditnotein__expirydate']) && ($_POST['creditnotein__expirydate'] == "" || $_POST['creditnotein__expirydate'] == null))
$error .= "<span class='error'>Expiry Date must not be empty"."</span><br>";

if (!isset($_POST['creditnotein__supplier_id']) || ($_POST['creditnotein__supplier_id'] == "" || $_POST['creditnotein__supplier_id'] == null  || $_POST['creditnotein__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['creditnotein__coa_id']) || ($_POST['creditnotein__coa_id'] == "" || $_POST['creditnotein__coa_id'] == null  || $_POST['creditnotein__coa_id'] == null))
$error .= "<span class='error'>Account must not be empty"."</span><br>";

if (!isset($_POST['creditnotein__currency_id']) || ($_POST['creditnotein__currency_id'] == "" || $_POST['creditnotein__currency_id'] == null  || $_POST['creditnotein__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['creditnotein__creditnoteinid']))
$data['creditnoteinid'] = $_POST['creditnotein__creditnoteinid'];if (isset($_POST['creditnotein__date']))
$this->db->set('date', "str_to_date('".$_POST['creditnotein__date']."', '%d-%m-%Y')", false);if (isset($_POST['creditnotein__expirydate']))
$this->db->set('expirydate', "str_to_date('".$_POST['creditnotein__expirydate']."', '%d-%m-%Y')", false);if (isset($_POST['creditnotein__supplier_id']))
$data['supplier_id'] = $_POST['creditnotein__supplier_id'];if (isset($_POST['creditnotein__coa_id']))
$data['coa_id'] = $_POST['creditnotein__coa_id'];if (isset($_POST['creditnotein__currency_id']))
$data['currency_id'] = $_POST['creditnotein__currency_id'];if (isset($_POST['creditnotein__amount']))
$data['amount'] = $_POST['creditnotein__amount'];if (isset($_POST['creditnotein__notes']))
$data['notes'] = $_POST['creditnotein__notes'];if (isset($_POST['creditnotein__usedflag']))
$data['usedflag'] = $_POST['creditnotein__usedflag'];
else $data['usedflag'] = false;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('creditnotein', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$creditnotein_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('credit_note_inadd','creditnotein','aftersave', $creditnotein_id);
			
		
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