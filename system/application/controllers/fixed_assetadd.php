<?php

class fixed_assetadd extends Controller {

	function fixed_assetadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['fixedasset__name'] = '';
$data['fixedasset__datebought'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__coa_id'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__paidusing_coa_id'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__depreciation_coa_id'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__accumulated_coa_id'] = '';
$data['fixedasset__estlifetime'] = '';
$data['fixedasset__cost'] = '';
$data['fixedasset__salvage'] = '';
$data['fixedasset__notes'] = '';
$data['fixedasset__lastupdate'] = '';
$data['fixedasset__updatedby'] = '';
$data['fixedasset__created'] = '';
$data['fixedasset__createdby'] = '';
		

		$this->load->view('fixed_asset_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['fixedasset__name']) && ($_POST['fixedasset__name'] == "" || $_POST['fixedasset__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (isset($_POST['fixedasset__datebought']) && ($_POST['fixedasset__datebought'] == "" || $_POST['fixedasset__datebought'] == null))
$error .= "<span class='error'>Date Buy must not be empty"."</span><br>";

if (!isset($_POST['fixedasset__coa_id']) || ($_POST['fixedasset__coa_id'] == "" || $_POST['fixedasset__coa_id'] == null  || $_POST['fixedasset__coa_id'] == null))
$error .= "<span class='error'>Fixed Asset Account must not be empty"."</span><br>";

if (!isset($_POST['fixedasset__paidusing_coa_id']) || ($_POST['fixedasset__paidusing_coa_id'] == "" || $_POST['fixedasset__paidusing_coa_id'] == null  || $_POST['fixedasset__paidusing_coa_id'] == null))
$error .= "<span class='error'>Pay Account must not be empty"."</span><br>";

if (!isset($_POST['fixedasset__depreciation_coa_id']) || ($_POST['fixedasset__depreciation_coa_id'] == "" || $_POST['fixedasset__depreciation_coa_id'] == null  || $_POST['fixedasset__depreciation_coa_id'] == null))
$error .= "<span class='error'>Depreciation Account must not be empty"."</span><br>";

if (!isset($_POST['fixedasset__accumulated_coa_id']) || ($_POST['fixedasset__accumulated_coa_id'] == "" || $_POST['fixedasset__accumulated_coa_id'] == null  || $_POST['fixedasset__accumulated_coa_id'] == null))
$error .= "<span class='error'>Accumulated Account must not be empty"."</span><br>";

if (isset($_POST['fixedasset__estlifetime']) && ($_POST['fixedasset__estlifetime'] == "" || $_POST['fixedasset__estlifetime'] == null))
$error .= "<span class='error'>Est Lifetime must not be empty"."</span><br>";

if (isset($_POST['fixedasset__cost']) && ($_POST['fixedasset__cost'] == "" || $_POST['fixedasset__cost'] == null))
$error .= "<span class='error'>Cost must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['fixedasset__name']))
$data['name'] = $_POST['fixedasset__name'];if (isset($_POST['fixedasset__datebought']))
$this->db->set('datebought', "str_to_date('".$_POST['fixedasset__datebought']."', '%d-%m-%Y')", false);if (isset($_POST['fixedasset__coa_id']))
$data['coa_id'] = $_POST['fixedasset__coa_id'];if (isset($_POST['fixedasset__paidusing_coa_id']))
$data['paidusing_coa_id'] = $_POST['fixedasset__paidusing_coa_id'];if (isset($_POST['fixedasset__depreciation_coa_id']))
$data['depreciation_coa_id'] = $_POST['fixedasset__depreciation_coa_id'];if (isset($_POST['fixedasset__accumulated_coa_id']))
$data['accumulated_coa_id'] = $_POST['fixedasset__accumulated_coa_id'];if (isset($_POST['fixedasset__estlifetime']))
$data['estlifetime'] = $_POST['fixedasset__estlifetime'];if (isset($_POST['fixedasset__cost']))
$data['cost'] = $_POST['fixedasset__cost'];if (isset($_POST['fixedasset__salvage']))
$data['salvage'] = $_POST['fixedasset__salvage'];if (isset($_POST['fixedasset__notes']))
$data['notes'] = $_POST['fixedasset__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('fixedasset', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$fixedasset_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('fixed_assetadd','fixedasset','aftersave', $fixedasset_id);
			
		
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