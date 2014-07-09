<?php

class suar_pengajuan_repairview extends Controller {

	function suar_pengajuan_repairview()
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
$this->load->view('suar_pengajuan_repair_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['suratpengajuanrepair__idstring'];
$data['date'] = $_POST['suratpengajuanrepair__date'];
$data['requester'] = $_POST['suratpengajuanrepair__requester'];
$data['lastupdate'] = $_POST['suratpengajuanrepair__lastupdate'];
$data['updatedby'] = $_POST['suratpengajuanrepair__updatedby'];
$data['created'] = $_POST['suratpengajuanrepair__created'];
$data['createdby'] = $_POST['suratpengajuanrepair__createdby'];
$this->db->where('id', $data['suar_pengajuan_repair_id']);
$this->db->update('suratpengajuanrepair', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>