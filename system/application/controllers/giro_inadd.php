<?php

class giro_inadd extends Controller {

	function giro_inadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['giroin__giroinid'] = '';$this->load->library('generallib');
$data['giroin__giroinid'] = $this->generallib->genId('Giro In');
$data['giroin__createdate'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['giroin__customer_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['giroin__currency_id'] = '';
$data['giroin__amount'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['giroin__coa_id'] = '';
$data['giroin__notes'] = '';
$data['giroin__usedflag'] = '';
$data['giroin__lastupdate'] = '';
$data['giroin__updatedby'] = '';
$data['giroin__created'] = '';
$data['giroin__createdby'] = '';
		

		$this->load->view('giro_in_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['giroin__giroinid']) && ($_POST['giroin__giroinid'] == "" || $_POST['giroin__giroinid'] == null))
$error .= "<span class='error'>Giro ID must not be empty"."</span><br>";

if (isset($_POST['giroin__giroinid'])) {
$this->db->where('giroinid', $_POST['giroin__giroinid']);
$q = $this->db->get('giroin');
if ($q->num_rows() > 0) $error .= "<span class='error'>Giro ID must be unique"."</span><br>";}

if (isset($_POST['giroin__createdate']) && ($_POST['giroin__createdate'] == "" || $_POST['giroin__createdate'] == null))
$error .= "<span class='error'>Creation Date must not be empty"."</span><br>";

if (!isset($_POST['giroin__customer_id']) || ($_POST['giroin__customer_id'] == "" || $_POST['giroin__customer_id'] == null  || $_POST['giroin__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['giroin__currency_id']) || ($_POST['giroin__currency_id'] == "" || $_POST['giroin__currency_id'] == null  || $_POST['giroin__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if (!isset($_POST['giroin__coa_id']) || ($_POST['giroin__coa_id'] == "" || $_POST['giroin__coa_id'] == null  || $_POST['giroin__coa_id'] == null))
$error .= "<span class='error'>Account must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['giroin__giroinid']))
$data['giroinid'] = $_POST['giroin__giroinid'];if (isset($_POST['giroin__createdate']))
$this->db->set('createdate', "str_to_date('".$_POST['giroin__createdate']."', '%d-%m-%Y')", false);if (isset($_POST['giroin__customer_id']))
$data['customer_id'] = $_POST['giroin__customer_id'];if (isset($_POST['giroin__currency_id']))
$data['currency_id'] = $_POST['giroin__currency_id'];if (isset($_POST['giroin__amount']))
$data['amount'] = $_POST['giroin__amount'];if (isset($_POST['giroin__coa_id']))
$data['coa_id'] = $_POST['giroin__coa_id'];if (isset($_POST['giroin__notes']))
$data['notes'] = $_POST['giroin__notes'];if (isset($_POST['giroin__usedflag']))
$data['usedflag'] = $_POST['giroin__usedflag'];
else $data['usedflag'] = false;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('giroin', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$giroin_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_inadd','giroin','aftersave', $giroin_id);
			
		
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