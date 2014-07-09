<?php

class bank_transfer_masukedit extends Controller {

	function bank_transfer_masukedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($bank_transfer_masuk_id=0)
	{
		if ($bank_transfer_masuk_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $bank_transfer_masuk_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('banktransfermasuk');
if ($q->num_rows() > 0) {
$data = array();
$data['bank_transfer_masuk_id'] = $bank_transfer_masuk_id;
foreach ($q->result() as $r) {
$data['banktransfermasuk__idstring'] = $r->idstring;
$data['banktransfermasuk__date'] = $r->date;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['banktransfermasuk__currency_id'] = $r->currency_id;
$data['banktransfermasuk__amount'] = $r->amount;
$data['banktransfermasuk__notes'] = $r->notes;
$data['banktransfermasuk__transferedflag'] = $r->transferedflag;
$data['banktransfermasuk__lastupdate'] = $r->lastupdate;
$data['banktransfermasuk__updatedby'] = $r->updatedby;
$data['banktransfermasuk__created'] = $r->created;
$data['banktransfermasuk__createdby'] = $r->createdby;}
$this->load->view('bank_transfer_masuk_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['banktransfermasuk__idstring']) && ($_POST['banktransfermasuk__idstring'] == "" || $_POST['banktransfermasuk__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['banktransfermasuk__idstring'])) {$this->db->where("id !=", $_POST['bank_transfer_masuk_id']);
$this->db->where('idstring', $_POST['banktransfermasuk__idstring']);
$q = $this->db->get('banktransfermasuk');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['banktransfermasuk__date']) && ($_POST['banktransfermasuk__date'] == "" || $_POST['banktransfermasuk__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['banktransfermasuk__currency_id']) || ($_POST['banktransfermasuk__currency_id'] == "" || $_POST['banktransfermasuk__currency_id'] == null  || $_POST['banktransfermasuk__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['banktransfermasuk__idstring']))
$data['idstring'] = $_POST['banktransfermasuk__idstring'];if (isset($_POST['banktransfermasuk__date']))
$this->db->set('date', "str_to_date('".$_POST['banktransfermasuk__date']."', '%d-%m-%Y')", false);if (isset($_POST['banktransfermasuk__currency_id']))
$data['currency_id'] = $_POST['banktransfermasuk__currency_id'];if (isset($_POST['banktransfermasuk__amount']))
$data['amount'] = $_POST['banktransfermasuk__amount'];if (isset($_POST['banktransfermasuk__notes']))
$data['notes'] = $_POST['banktransfermasuk__notes'];
if (isset($_POST['banktransfermasuk__transferedflag']))
$data['transferedflag'] = 1;
else
$data['transferedflag'] = 0;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['bank_transfer_masuk_id']);
$this->db->update('banktransfermasuk', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('bank_transfer_masukedit','banktransfermasuk','afteredit', $_POST['bank_transfer_masuk_id']);
			
			
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