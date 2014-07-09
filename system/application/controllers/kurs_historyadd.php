<?php

class kurs_historyadd extends Controller {

	function kurs_historyadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['kurshistory__idstring'] = '';$this->load->library('generallib');
$data['kurshistory__idstring'] = $this->generallib->genId('Kurs History');
$data['kurshistory__date'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['kurshistory__currency_id'] = '';
$data['kurshistory__value'] = '';
$data['kurshistory__notes'] = '';
$data['kurshistory__lastupdate'] = '';
$data['kurshistory__updatedby'] = '';
$data['kurshistory__created'] = '';
$data['kurshistory__createdby'] = '';
		

		$this->load->view('kurs_history_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['kurshistory__idstring']) && ($_POST['kurshistory__idstring'] == "" || $_POST['kurshistory__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['kurshistory__idstring'])) {
$this->db->where('idstring', $_POST['kurshistory__idstring']);
$q = $this->db->get('kurshistory');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['kurshistory__date']) && ($_POST['kurshistory__date'] == "" || $_POST['kurshistory__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['kurshistory__currency_id']) || ($_POST['kurshistory__currency_id'] == "" || $_POST['kurshistory__currency_id'] == null  || $_POST['kurshistory__currency_id'] == null))
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
$this->db->insert('kurshistory', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$kurshistory_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('kurs_historyadd','kurshistory','aftersave', $kurshistory_id);
			
		
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