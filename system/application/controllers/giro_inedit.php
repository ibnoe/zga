<?php

class giro_inedit extends Controller {

	function giro_inedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_in_id=0)
	{
		if ($giro_in_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $giro_in_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(createdate, "%d-%m-%Y") as createdate', false);
$q = $this->db->get('giroin');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_in_id'] = $giro_in_id;
foreach ($q->result() as $r) {
$data['giroin__giroinid'] = $r->giroinid;
$data['giroin__createdate'] = $r->createdate;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['giroin__customer_id'] = $r->customer_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['giroin__currency_id'] = $r->currency_id;
$data['giroin__amount'] = $r->amount;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['giroin__coa_id'] = $r->coa_id;
$data['giroin__notes'] = $r->notes;
$data['giroin__usedflag'] = $r->usedflag;
$data['giroin__lastupdate'] = $r->lastupdate;
$data['giroin__updatedby'] = $r->updatedby;
$data['giroin__created'] = $r->created;
$data['giroin__createdby'] = $r->createdby;}
$this->load->view('giro_in_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['giroin__giroinid']) && ($_POST['giroin__giroinid'] == "" || $_POST['giroin__giroinid'] == null))
$error .= "<span class='error'>Giro ID must not be empty"."</span><br>";

if (isset($_POST['giroin__giroinid'])) {$this->db->where("id !=", $_POST['giro_in_id']);
$this->db->where('giroinid', $_POST['giroin__giroinid']);
$q = $this->db->get('giroin');
if ($q->num_rows() > 0) $error .= "<span class='error'>Giro ID must be unique"."</span><br>";}

if (isset($_POST['giroin__createdate']) && ($_POST['giroin__createdate'] == "" || $_POST['giroin__createdate'] == null))
$error .= "<span class='error'>Creation Date must not be empty"."</span><br>";

if (!isset($_POST['giroin__customer_id']) || ($_POST['giroin__customer_id'] == "" || $_POST['giroin__customer_id'] == null  || $_POST['giroin__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['giroin__currency_id']) || ($_POST['giroin__currency_id'] == "" || $_POST['giroin__currency_id'] == null  || $_POST['giroin__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if (!isset($_POST['giroin__coa_id']) || ($_POST['giroin__coa_id'] == "" || $_POST['giroin__coa_id'] == null  || $_POST['giroin__coa_id'] == 0))
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
$data['notes'] = $_POST['giroin__notes'];
if (isset($_POST['giroin__usedflag']))
$data['usedflag'] = 1;
else
$data['usedflag'] = 0;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['giro_in_id']);
$this->db->update('giroin', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_inedit','giroin','afteredit', $_POST['giro_in_id']);
			
			
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