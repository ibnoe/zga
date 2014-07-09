<?php

class bank_transfer_keluaredit extends Controller {

	function bank_transfer_keluaredit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($bank_transfer_keluar_id=0)
	{
		if ($bank_transfer_keluar_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $bank_transfer_keluar_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('banktransferkeluar');
if ($q->num_rows() > 0) {
$data = array();
$data['bank_transfer_keluar_id'] = $bank_transfer_keluar_id;
foreach ($q->result() as $r) {
$data['banktransferkeluar__idstring'] = $r->idstring;
$data['banktransferkeluar__date'] = $r->date;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['banktransferkeluar__currency_id'] = $r->currency_id;
$data['banktransferkeluar__amount'] = $r->amount;
$data['banktransferkeluar__notes'] = $r->notes;
$data['banktransferkeluar__transferedflag'] = $r->transferedflag;
$data['banktransferkeluar__lastupdate'] = $r->lastupdate;
$data['banktransferkeluar__updatedby'] = $r->updatedby;
$data['banktransferkeluar__created'] = $r->created;
$data['banktransferkeluar__createdby'] = $r->createdby;}
$this->load->view('bank_transfer_keluar_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['banktransferkeluar__idstring']) && ($_POST['banktransferkeluar__idstring'] == "" || $_POST['banktransferkeluar__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['banktransferkeluar__idstring'])) {$this->db->where("id !=", $_POST['bank_transfer_keluar_id']);
$this->db->where('idstring', $_POST['banktransferkeluar__idstring']);
$q = $this->db->get('banktransferkeluar');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['banktransferkeluar__date']) && ($_POST['banktransferkeluar__date'] == "" || $_POST['banktransferkeluar__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['banktransferkeluar__currency_id']) || ($_POST['banktransferkeluar__currency_id'] == "" || $_POST['banktransferkeluar__currency_id'] == null  || $_POST['banktransferkeluar__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['banktransferkeluar__idstring']))
$data['idstring'] = $_POST['banktransferkeluar__idstring'];if (isset($_POST['banktransferkeluar__date']))
$this->db->set('date', "str_to_date('".$_POST['banktransferkeluar__date']."', '%d-%m-%Y')", false);if (isset($_POST['banktransferkeluar__currency_id']))
$data['currency_id'] = $_POST['banktransferkeluar__currency_id'];if (isset($_POST['banktransferkeluar__amount']))
$data['amount'] = $_POST['banktransferkeluar__amount'];if (isset($_POST['banktransferkeluar__notes']))
$data['notes'] = $_POST['banktransferkeluar__notes'];
if (isset($_POST['banktransferkeluar__transferedflag']))
$data['transferedflag'] = 1;
else
$data['transferedflag'] = 0;
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['bank_transfer_keluar_id']);
$this->db->update('banktransferkeluar', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('bank_transfer_keluaredit','banktransferkeluar','afteredit', $_POST['bank_transfer_keluar_id']);
			
			
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