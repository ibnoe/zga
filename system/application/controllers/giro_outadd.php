<?php

class giro_outadd extends Controller {

	function giro_outadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['giroout__girooutid'] = '';$this->load->library('generallib');
$data['giroout__girooutid'] = $this->generallib->genId('Giro Out');
$data['giroout__createdate'] = '';
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['giroout__supplier_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['giroout__currency_id'] = '';
$data['giroout__amount'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['giroout__coa_id'] = '';
$data['giroout__notes'] = '';
$data['giroout__usedflag'] = '';
$data['giroout__lastupdate'] = '';
$data['giroout__updatedby'] = '';
$data['giroout__created'] = '';
$data['giroout__createdby'] = '';
		

		$this->load->view('giro_out_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['giroout__girooutid']) && ($_POST['giroout__girooutid'] == "" || $_POST['giroout__girooutid'] == null))
$error .= "<span class='error'>Giro ID must not be empty"."</span><br>";

if (isset($_POST['giroout__girooutid'])) {
$this->db->where('girooutid', $_POST['giroout__girooutid']);
$q = $this->db->get('giroout');
if ($q->num_rows() > 0) $error .= "<span class='error'>Giro ID must be unique"."</span><br>";}

if (isset($_POST['giroout__createdate']) && ($_POST['giroout__createdate'] == "" || $_POST['giroout__createdate'] == null))
$error .= "<span class='error'>Creation Date must not be empty"."</span><br>";

if (!isset($_POST['giroout__supplier_id']) || ($_POST['giroout__supplier_id'] == "" || $_POST['giroout__supplier_id'] == null  || $_POST['giroout__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['giroout__currency_id']) || ($_POST['giroout__currency_id'] == "" || $_POST['giroout__currency_id'] == null  || $_POST['giroout__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if (!isset($_POST['giroout__coa_id']) || ($_POST['giroout__coa_id'] == "" || $_POST['giroout__coa_id'] == null  || $_POST['giroout__coa_id'] == null))
$error .= "<span class='error'>Account must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['giroout__girooutid']))
$data['girooutid'] = $_POST['giroout__girooutid'];if (isset($_POST['giroout__createdate']))
$this->db->set('createdate', "str_to_date('".$_POST['giroout__createdate']."', '%d-%m-%Y')", false);if (isset($_POST['giroout__supplier_id']))
$data['supplier_id'] = $_POST['giroout__supplier_id'];if (isset($_POST['giroout__currency_id']))
$data['currency_id'] = $_POST['giroout__currency_id'];if (isset($_POST['giroout__amount']))
$data['amount'] = $_POST['giroout__amount'];if (isset($_POST['giroout__coa_id']))
$data['coa_id'] = $_POST['giroout__coa_id'];if (isset($_POST['giroout__notes']))
$data['notes'] = $_POST['giroout__notes'];if (isset($_POST['giroout__usedflag']))
$data['usedflag'] = $_POST['giroout__usedflag'];
else $data['usedflag'] = false;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('giroout', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$giroout_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_outadd','giroout','aftersave', $giroout_id);
			
		
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