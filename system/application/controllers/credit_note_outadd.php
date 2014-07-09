<?php

class credit_note_outadd extends Controller {

	function credit_note_outadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['creditnoteout__creditnoteoutid'] = '';$this->load->library('generallib');
$data['creditnoteout__creditnoteoutid'] = $this->generallib->genId('Credit Note Out');
$data['creditnoteout__date'] = '';
$data['creditnoteout__expirydate'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['creditnoteout__customer_id'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['creditnoteout__coa_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['creditnoteout__currency_id'] = '';
$data['creditnoteout__amount'] = '';
$data['creditnoteout__notes'] = '';
$data['creditnoteout__usedflag'] = '0';
$data['creditnoteout__lastupdate'] = '';
$data['creditnoteout__updatedby'] = '';
$data['creditnoteout__created'] = '';
$data['creditnoteout__createdby'] = '';
		

		$this->load->view('credit_note_out_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['creditnoteout__creditnoteoutid']) && ($_POST['creditnoteout__creditnoteoutid'] == "" || $_POST['creditnoteout__creditnoteoutid'] == null))
$error .= "<span class='error'>CN ID must not be empty"."</span><br>";

if (isset($_POST['creditnoteout__creditnoteoutid'])) {
$this->db->where('creditnoteoutid', $_POST['creditnoteout__creditnoteoutid']);
$q = $this->db->get('creditnoteout');
if ($q->num_rows() > 0) $error .= "<span class='error'>CN ID must be unique"."</span><br>";}

if (isset($_POST['creditnoteout__date']) && ($_POST['creditnoteout__date'] == "" || $_POST['creditnoteout__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['creditnoteout__expirydate']) && ($_POST['creditnoteout__expirydate'] == "" || $_POST['creditnoteout__expirydate'] == null))
$error .= "<span class='error'>Expiry Date must not be empty"."</span><br>";

if (!isset($_POST['creditnoteout__customer_id']) || ($_POST['creditnoteout__customer_id'] == "" || $_POST['creditnoteout__customer_id'] == null  || $_POST['creditnoteout__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['creditnoteout__coa_id']) || ($_POST['creditnoteout__coa_id'] == "" || $_POST['creditnoteout__coa_id'] == null  || $_POST['creditnoteout__coa_id'] == null))
$error .= "<span class='error'>Account must not be empty"."</span><br>";

if (!isset($_POST['creditnoteout__currency_id']) || ($_POST['creditnoteout__currency_id'] == "" || $_POST['creditnoteout__currency_id'] == null  || $_POST['creditnoteout__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['creditnoteout__creditnoteoutid']))
$data['creditnoteoutid'] = $_POST['creditnoteout__creditnoteoutid'];if (isset($_POST['creditnoteout__date']))
$this->db->set('date', "str_to_date('".$_POST['creditnoteout__date']."', '%d-%m-%Y')", false);if (isset($_POST['creditnoteout__expirydate']))
$this->db->set('expirydate', "str_to_date('".$_POST['creditnoteout__expirydate']."', '%d-%m-%Y')", false);if (isset($_POST['creditnoteout__customer_id']))
$data['customer_id'] = $_POST['creditnoteout__customer_id'];if (isset($_POST['creditnoteout__coa_id']))
$data['coa_id'] = $_POST['creditnoteout__coa_id'];if (isset($_POST['creditnoteout__currency_id']))
$data['currency_id'] = $_POST['creditnoteout__currency_id'];if (isset($_POST['creditnoteout__amount']))
$data['amount'] = $_POST['creditnoteout__amount'];if (isset($_POST['creditnoteout__notes']))
$data['notes'] = $_POST['creditnoteout__notes'];if (isset($_POST['creditnoteout__usedflag']))
$data['usedflag'] = $_POST['creditnoteout__usedflag'];
else $data['usedflag'] = false;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('creditnoteout', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$creditnoteout_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('credit_note_outadd','creditnoteout','aftersave', $creditnoteout_id);
			
		
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