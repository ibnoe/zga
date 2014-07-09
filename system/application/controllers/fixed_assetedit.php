<?php

class fixed_assetedit extends Controller {

	function fixed_assetedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($fixed_asset_id=0)
	{
		if ($fixed_asset_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $fixed_asset_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(datebought, "%d-%m-%Y") as datebought', false);
$q = $this->db->get('fixedasset');
if ($q->num_rows() > 0) {
$data = array();
$data['fixed_asset_id'] = $fixed_asset_id;
foreach ($q->result() as $r) {
$data['fixedasset__name'] = $r->name;
$data['fixedasset__datebought'] = $r->datebought;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__coa_id'] = $r->coa_id;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__paidusing_coa_id'] = $r->paidusing_coa_id;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__depreciation_coa_id'] = $r->depreciation_coa_id;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['fixedasset__accumulated_coa_id'] = $r->accumulated_coa_id;
$data['fixedasset__estlifetime'] = $r->estlifetime;
$data['fixedasset__cost'] = $r->cost;
$data['fixedasset__salvage'] = $r->salvage;
$data['fixedasset__notes'] = $r->notes;
$data['fixedasset__lastupdate'] = $r->lastupdate;
$data['fixedasset__updatedby'] = $r->updatedby;
$data['fixedasset__created'] = $r->created;
$data['fixedasset__createdby'] = $r->createdby;}
$this->load->view('fixed_asset_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['fixedasset__name']) && ($_POST['fixedasset__name'] == "" || $_POST['fixedasset__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (isset($_POST['fixedasset__datebought']) && ($_POST['fixedasset__datebought'] == "" || $_POST['fixedasset__datebought'] == null))
$error .= "<span class='error'>Date Buy must not be empty"."</span><br>";

if (!isset($_POST['fixedasset__coa_id']) || ($_POST['fixedasset__coa_id'] == "" || $_POST['fixedasset__coa_id'] == null  || $_POST['fixedasset__coa_id'] == 0))
$error .= "<span class='error'>Fixed Asset Account must not be empty"."</span><br>";

if (!isset($_POST['fixedasset__paidusing_coa_id']) || ($_POST['fixedasset__paidusing_coa_id'] == "" || $_POST['fixedasset__paidusing_coa_id'] == null  || $_POST['fixedasset__paidusing_coa_id'] == 0))
$error .= "<span class='error'>Pay Account must not be empty"."</span><br>";

if (!isset($_POST['fixedasset__depreciation_coa_id']) || ($_POST['fixedasset__depreciation_coa_id'] == "" || $_POST['fixedasset__depreciation_coa_id'] == null  || $_POST['fixedasset__depreciation_coa_id'] == 0))
$error .= "<span class='error'>Depreciation Account must not be empty"."</span><br>";

if (!isset($_POST['fixedasset__accumulated_coa_id']) || ($_POST['fixedasset__accumulated_coa_id'] == "" || $_POST['fixedasset__accumulated_coa_id'] == null  || $_POST['fixedasset__accumulated_coa_id'] == 0))
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
$this->db->where('id', $_POST['fixed_asset_id']);
$this->db->update('fixedasset', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('fixed_assetedit','fixedasset','afteredit', $_POST['fixed_asset_id']);
			
			
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