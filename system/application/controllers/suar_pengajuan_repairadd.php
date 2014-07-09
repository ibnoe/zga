<?php

class suar_pengajuan_repairadd extends Controller {

	function suar_pengajuan_repairadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['suratpengajuanrepair__idstring'] = '';
$data['suratpengajuanrepair__date'] = '';
$data['suratpengajuanrepair__requester'] = '';
$data['suratpengajuanrepair__lastupdate'] = '';
$data['suratpengajuanrepair__updatedby'] = '';
$data['suratpengajuanrepair__created'] = '';
$data['suratpengajuanrepair__createdby'] = '';
		

		$this->load->view('suar_pengajuan_repair_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['suratpengajuanrepair__idstring']) && ($_POST['suratpengajuanrepair__idstring'] == "" || $_POST['suratpengajuanrepair__idstring'] == null))
$error .= "<span class='error'>No Form must not be empty"."</span><br>";

if (isset($_POST['suratpengajuanrepair__idstring'])) {
$this->db->where('idstring', $_POST['suratpengajuanrepair__idstring']);
$q = $this->db->get('suratpengajuanrepair');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Form must be unique"."</span><br>";}

if (isset($_POST['suratpengajuanrepair__date']) && ($_POST['suratpengajuanrepair__date'] == "" || $_POST['suratpengajuanrepair__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

$this->load->library('generallib');
$error .= $this->generallib->commonfunction('suar_pengajuan_repairadd','suratpengajuanrepair','validation', 0, $_POST);
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['suratpengajuanrepair__idstring']))
$data['idstring'] = $_POST['suratpengajuanrepair__idstring'];if (isset($_POST['suratpengajuanrepair__date']))
$data['date'] = $_POST['suratpengajuanrepair__date'];if (isset($_POST['suratpengajuanrepair__requester']))
$data['requester'] = $_POST['suratpengajuanrepair__requester'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('suratpengajuanrepair', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$suratpengajuanrepair_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('suar_pengajuan_repairadd','suratpengajuanrepair','aftersave', $suratpengajuanrepair_id);
	
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>