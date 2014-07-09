<?php

class credit_note_inedit extends Controller {

	function credit_note_inedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($credit_note_in_id=0)
	{
		if ($credit_note_in_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $credit_note_in_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$this->db->select('DATE_FORMAT(expirydate, "%d-%m-%Y") as expirydate', false);
$q = $this->db->get('creditnotein');
if ($q->num_rows() > 0) {
$data = array();
$data['credit_note_in_id'] = $credit_note_in_id;
foreach ($q->result() as $r) {
$data['creditnotein__creditnoteinid'] = $r->creditnoteinid;
$data['creditnotein__date'] = $r->date;
$data['creditnotein__expirydate'] = $r->expirydate;
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['creditnotein__supplier_id'] = $r->supplier_id;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['creditnotein__coa_id'] = $r->coa_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['creditnotein__currency_id'] = $r->currency_id;
$data['creditnotein__amount'] = $r->amount;
$data['creditnotein__notes'] = $r->notes;
$data['creditnotein__usedflag'] = $r->usedflag;
$data['creditnotein__lastupdate'] = $r->lastupdate;
$data['creditnotein__updatedby'] = $r->updatedby;
$data['creditnotein__created'] = $r->created;
$data['creditnotein__createdby'] = $r->createdby;}
$this->load->view('credit_note_in_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['creditnotein__creditnoteinid']) && ($_POST['creditnotein__creditnoteinid'] == "" || $_POST['creditnotein__creditnoteinid'] == null))
$error .= "<span class='error'>CN ID must not be empty"."</span><br>";

if (isset($_POST['creditnotein__creditnoteinid'])) {$this->db->where("id !=", $_POST['credit_note_in_id']);
$this->db->where('creditnoteinid', $_POST['creditnotein__creditnoteinid']);
$q = $this->db->get('creditnotein');
if ($q->num_rows() > 0) $error .= "<span class='error'>CN ID must be unique"."</span><br>";}

if (isset($_POST['creditnotein__date']) && ($_POST['creditnotein__date'] == "" || $_POST['creditnotein__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['creditnotein__expirydate']) && ($_POST['creditnotein__expirydate'] == "" || $_POST['creditnotein__expirydate'] == null))
$error .= "<span class='error'>Expiry Date must not be empty"."</span><br>";

if (!isset($_POST['creditnotein__supplier_id']) || ($_POST['creditnotein__supplier_id'] == "" || $_POST['creditnotein__supplier_id'] == null  || $_POST['creditnotein__supplier_id'] == 0))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['creditnotein__coa_id']) || ($_POST['creditnotein__coa_id'] == "" || $_POST['creditnotein__coa_id'] == null  || $_POST['creditnotein__coa_id'] == 0))
$error .= "<span class='error'>Account must not be empty"."</span><br>";

if (!isset($_POST['creditnotein__currency_id']) || ($_POST['creditnotein__currency_id'] == "" || $_POST['creditnotein__currency_id'] == null  || $_POST['creditnotein__currency_id'] == 0))
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
$data['notes'] = $_POST['creditnotein__notes'];
if (isset($_POST['creditnotein__usedflag']))
$data['usedflag'] = 1;
else
$data['usedflag'] = 0;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['credit_note_in_id']);
$this->db->update('creditnotein', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('credit_note_inedit','creditnotein','afteredit', $_POST['credit_note_in_id']);
			
			
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