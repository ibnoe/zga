<?php

class kurs_historyedit extends Controller {

	function kurs_historyedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($kurs_history_id=0)
	{
		if ($kurs_history_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $kurs_history_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('kurshistory');
if ($q->num_rows() > 0) {
$data = array();
$data['kurs_history_id'] = $kurs_history_id;
foreach ($q->result() as $r) {
$data['kurshistory__idstring'] = $r->idstring;
$data['kurshistory__date'] = $r->date;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['kurshistory__currency_id'] = $r->currency_id;
$data['kurshistory__value'] = $r->value;
$data['kurshistory__notes'] = $r->notes;
$data['kurshistory__lastupdate'] = $r->lastupdate;
$data['kurshistory__updatedby'] = $r->updatedby;
$data['kurshistory__created'] = $r->created;
$data['kurshistory__createdby'] = $r->createdby;}
$this->load->view('kurs_history_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['kurshistory__idstring']) && ($_POST['kurshistory__idstring'] == "" || $_POST['kurshistory__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['kurshistory__idstring'])) {$this->db->where("id !=", $_POST['kurs_history_id']);
$this->db->where('idstring', $_POST['kurshistory__idstring']);
$q = $this->db->get('kurshistory');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['kurshistory__date']) && ($_POST['kurshistory__date'] == "" || $_POST['kurshistory__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['kurshistory__currency_id']) || ($_POST['kurshistory__currency_id'] == "" || $_POST['kurshistory__currency_id'] == null  || $_POST['kurshistory__currency_id'] == 0))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['kurshistory__idstring']))
$data['idstring'] = $_POST['kurshistory__idstring'];if (isset($_POST['kurshistory__date']))
$this->db->set('date', "str_to_date('".$_POST['kurshistory__date']."', '%d-%m-%Y')", false);if (isset($_POST['kurshistory__currency_id']))
$data['currency_id'] = $_POST['kurshistory__currency_id'];if (isset($_POST['kurshistory__value']))
$data['value'] = $_POST['kurshistory__value'];if (isset($_POST['kurshistory__notes']))
$data['notes'] = $_POST['kurshistory__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['kurs_history_id']);
$this->db->update('kurshistory', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('kurs_historyedit','kurshistory','afteredit', $_POST['kurs_history_id']);
			
			
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