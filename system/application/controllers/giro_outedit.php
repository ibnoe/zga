<?php

class giro_outedit extends Controller {

	function giro_outedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_out_id=0)
	{
		if ($giro_out_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $giro_out_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(createdate, "%d-%m-%Y") as createdate', false);
$q = $this->db->get('giroout');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_out_id'] = $giro_out_id;
foreach ($q->result() as $r) {
$data['giroout__girooutid'] = $r->girooutid;
$data['giroout__createdate'] = $r->createdate;
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['giroout__supplier_id'] = $r->supplier_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['giroout__currency_id'] = $r->currency_id;
$data['giroout__amount'] = $r->amount;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['giroout__coa_id'] = $r->coa_id;
$data['giroout__notes'] = $r->notes;
$data['giroout__usedflag'] = $r->usedflag;
$data['giroout__lastupdate'] = $r->lastupdate;
$data['giroout__updatedby'] = $r->updatedby;
$data['giroout__created'] = $r->created;
$data['giroout__createdby'] = $r->createdby;}
$this->load->view('giro_out_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['giroout__girooutid']) && ($_POST['giroout__girooutid'] == "" || $_POST['giroout__girooutid'] == null))
$error .= "<span class='error'>Giro ID must not be empty"."</span><br>";

if (isset($_POST['giroout__girooutid'])) {$this->db->where("id !=", $_POST['giro_out_id']);
$this->db->where('girooutid', $_POST['giroout__girooutid']);
$q = $this->db->get('giroout');
if ($q->num_rows() > 0) $error .= "<span class='error'>Giro ID must be unique"."</span><br>";}

if (isset($_POST['giroout__createdate']) && ($_POST['giroout__createdate'] == "" || $_POST['giroout__createdate'] == null))
$error .= "<span class='error'>Creation Date must not be empty"."</span><br>";

if (!isset($_POST['giroout__supplier_id']) || ($_POST['giroout__supplier_id'] == "" || $_POST['giroout__supplier_id'] == null  || $_POST['giroout__supplier_id'] == 0))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['giroout__currency_id']) || ($_POST['giroout__currency_id'] == "" || $_POST['giroout__currency_id'] == null  || $_POST['giroout__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if (!isset($_POST['giroout__coa_id']) || ($_POST['giroout__coa_id'] == "" || $_POST['giroout__coa_id'] == null  || $_POST['giroout__coa_id'] == 0))
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
$data['notes'] = $_POST['giroout__notes'];
if (isset($_POST['giroout__usedflag']))
$data['usedflag'] = 1;
else
$data['usedflag'] = 0;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['giro_out_id']);
$this->db->update('giroout', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_outedit','giroout','afteredit', $_POST['giro_out_id']);
			
			
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