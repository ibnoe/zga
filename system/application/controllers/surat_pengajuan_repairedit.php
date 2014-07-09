<?php

class surat_pengajuan_repairedit extends Controller {

	function surat_pengajuan_repairedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($surat_pengajuan_repair_id=0)
	{
		if ($surat_pengajuan_repair_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $surat_pengajuan_repair_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('suratpengajuanrepair');
if ($q->num_rows() > 0) {
$data = array();
$data['surat_pengajuan_repair_id'] = $surat_pengajuan_repair_id;
foreach ($q->result() as $r) {
$data['suratpengajuanrepair__idstring'] = $r->idstring;
$data['suratpengajuanrepair__date'] = $r->date;
$data['suratpengajuanrepair__requester'] = $r->requester;
$data['suratpengajuanrepair__lastupdate'] = $r->lastupdate;
$data['suratpengajuanrepair__updatedby'] = $r->updatedby;
$data['suratpengajuanrepair__created'] = $r->created;
$data['suratpengajuanrepair__createdby'] = $r->createdby;}
$this->load->view('surat_pengajuan_repair_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['suratpengajuanrepair__idstring']) && ($_POST['suratpengajuanrepair__idstring'] == "" || $_POST['suratpengajuanrepair__idstring'] == null))
$error .= "<span class='error'>No Form must not be empty"."</span><br>";

if (isset($_POST['suratpengajuanrepair__idstring'])) {$this->db->where("id !=", $_POST['surat_pengajuan_repair_id']);
$this->db->where('idstring', $_POST['suratpengajuanrepair__idstring']);
$q = $this->db->get('suratpengajuanrepair');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Form must be unique"."</span><br>";}

if (isset($_POST['suratpengajuanrepair__date']) && ($_POST['suratpengajuanrepair__date'] == "" || $_POST['suratpengajuanrepair__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['suratpengajuanrepair__idstring']))
$data['idstring'] = $_POST['suratpengajuanrepair__idstring'];if (isset($_POST['suratpengajuanrepair__date']))
$this->db->set('date', "str_to_date('".$_POST['suratpengajuanrepair__date']."', '%d-%m-%Y')", false);if (isset($_POST['suratpengajuanrepair__requester']))
$data['requester'] = $_POST['suratpengajuanrepair__requester'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['surat_pengajuan_repair_id']);
$this->db->update('suratpengajuanrepair', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('surat_pengajuan_repairedit','suratpengajuanrepair','afteredit', $_POST['surat_pengajuan_repair_id']);
			
			
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