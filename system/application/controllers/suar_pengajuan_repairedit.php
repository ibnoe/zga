<?php

class suar_pengajuan_repairedit extends Controller {

	function suar_pengajuan_repairedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($suar_pengajuan_repair_id=0)
	{
		if ($suar_pengajuan_repair_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $suar_pengajuan_repair_id);
$q = $this->db->get('suratpengajuanrepair');
if ($q->num_rows() > 0) {
$data = array();
$data['suar_pengajuan_repair_id'] = $suar_pengajuan_repair_id;
foreach ($q->result() as $r) {
$data['suratpengajuanrepair__idstring'] = $r->idstring;
$data['suratpengajuanrepair__date'] = $r->date;
$data['suratpengajuanrepair__requester'] = $r->requester;
$data['suratpengajuanrepair__lastupdate'] = $r->lastupdate;
$data['suratpengajuanrepair__updatedby'] = $r->updatedby;
$data['suratpengajuanrepair__created'] = $r->created;
$data['suratpengajuanrepair__createdby'] = $r->createdby;}
$this->load->view('suar_pengajuan_repair_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['suratpengajuanrepair__idstring'])) {$this->db->where("id !=", $_POST['suar_pengajuan_repair_id']);
$this->db->where('idstring', $_POST['suratpengajuanrepair__idstring']);
$q = $this->db->get('suratpengajuanrepair');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Form must be unique"."</span><br>";}

		
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
$this->db->where('id', $_POST['suar_pengajuan_repair_id']);
$this->db->update('suratpengajuanrepair', $data);
$this->load->library('generallib');
$this->generallib->commonfunction('suar_pengajuan_repairedit','suratpengajuanrepair','aftersave');
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>