<?php

class penawaranedit extends Controller {

	function penawaranedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($penawaran_id=0)
	{
		if ($penawaran_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $penawaran_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('salesorderquote');
if ($q->num_rows() > 0) {
$data = array();
$data['penawaran_id'] = $penawaran_id;
foreach ($q->result() as $r) {
$data['salesorderquote__nopenawaran'] = $r->nopenawaran;
$data['salesorderquote__customerponumber'] = $r->customerponumber;
$data['salesorderquote__date'] = $r->date;
$data['salesorderquote__notes'] = $r->notes;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesorderquote__customer_id'] = $r->customer_id;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesorderquote__currency_id'] = $r->currency_id;
$data['salesorderquote__currencyrate'] = $r->currencyrate;
$marketingofficer_opt = array();
$marketingofficer_opt[''] = 'None';
$q = $this->db->get('marketingofficer');
foreach ($q->result() as $row) { $marketingofficer_opt[$row->id] = $row->name; }
$data['marketingofficer_opt'] = $marketingofficer_opt;
$data['salesorderquote__marketingofficer_id'] = $r->marketingofficer_id;
$data['salesorderquote__status'] = $r->status;
$data['salesorderquote__orderid'] = $r->orderid;
$data['salesorderquote__modulename'] = $r->modulename;
$data['salesorderquote__lastupdate'] = $r->lastupdate;
$data['salesorderquote__updatedby'] = $r->updatedby;
$data['salesorderquote__created'] = $r->created;
$data['salesorderquote__createdby'] = $r->createdby;}
$this->load->view('penawaran_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['salesorderquote__nopenawaran']) && ($_POST['salesorderquote__nopenawaran'] == "" || $_POST['salesorderquote__nopenawaran'] == null))
$error .= "<span class='error'>No Penawaran must not be empty"."</span><br>";

if (isset($_POST['salesorderquote__nopenawaran'])) {$this->db->where("id !=", $_POST['penawaran_id']);
$this->db->where('nopenawaran', $_POST['salesorderquote__nopenawaran']);
$q = $this->db->get('salesorderquote');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Penawaran must be unique"."</span><br>";}

if (isset($_POST['salesorderquote__customerponumber'])) {$this->db->where("id !=", $_POST['penawaran_id']);
$this->db->where('customerponumber', $_POST['salesorderquote__customerponumber']);
$q = $this->db->get('salesorderquote');
if ($q->num_rows() > 0) $error .= "<span class='error'>No PO must be unique"."</span><br>";}

if (isset($_POST['salesorderquote__date']) && ($_POST['salesorderquote__date'] == "" || $_POST['salesorderquote__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['salesorderquote__customer_id']) || ($_POST['salesorderquote__customer_id'] == "" || $_POST['salesorderquote__customer_id'] == null  || $_POST['salesorderquote__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesorderquote__currency_id']) || ($_POST['salesorderquote__currency_id'] == "" || $_POST['salesorderquote__currency_id'] == null  || $_POST['salesorderquote__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['salesorderquote__status'] == "Approved")
if (isset($_POST['salesorderquote__orderid']) && ($_POST['salesorderquote__orderid'] == "" || $_POST['salesorderquote__orderid'] == null))
$error .= "<span class='error'>SO ID must not be empty"."</span><br>";

if (isset($_POST['salesorderquote__orderid'])) {$this->db->where("id !=", $_POST['penawaran_id']);
$this->db->where('orderid', $_POST['salesorderquote__orderid']);
$q = $this->db->get('salesorderquote');
if ($q->num_rows() > 0) $error .= "<span class='error'>SO ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesorderquote__nopenawaran']))
$data['nopenawaran'] = $_POST['salesorderquote__nopenawaran'];if (isset($_POST['salesorderquote__customerponumber']))
$data['customerponumber'] = $_POST['salesorderquote__customerponumber'];if (isset($_POST['salesorderquote__date']))
$this->db->set('date', "str_to_date('".$_POST['salesorderquote__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesorderquote__notes']))
$data['notes'] = $_POST['salesorderquote__notes'];if (isset($_POST['salesorderquote__customer_id']))
$data['customer_id'] = $_POST['salesorderquote__customer_id'];if (isset($_POST['salesorderquote__currency_id']))
$data['currency_id'] = $_POST['salesorderquote__currency_id'];if (isset($_POST['salesorderquote__currencyrate']))
$data['currencyrate'] = $_POST['salesorderquote__currencyrate'];if (isset($_POST['salesorderquote__marketingofficer_id']))
$data['marketingofficer_id'] = $_POST['salesorderquote__marketingofficer_id'];if (isset($_POST['salesorderquote__status']))
$data['status'] = $_POST['salesorderquote__status'];if (isset($_POST['salesorderquote__orderid']))
$data['orderid'] = $_POST['salesorderquote__orderid'];if (isset($_POST['salesorderquote__modulename']))
$data['modulename'] = $_POST['salesorderquote__modulename'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['penawaran_id']);
$this->db->update('salesorderquote', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('penawaranedit','salesorderquote','afteredit', $_POST['penawaran_id']);
			
			
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