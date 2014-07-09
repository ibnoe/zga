<?php

class surat_pengajuan_repair_lineview extends Controller {

	function surat_pengajuan_repair_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($surat_pengajuan_repair_line_id=0)
	{
		if ($surat_pengajuan_repair_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $surat_pengajuan_repair_line_id);
$this->db->select('*');
$q = $this->db->get('suratpengajuanrepairline');
if ($q->num_rows() > 0) {
$data = array();
$data['surat_pengajuan_repair_line_id'] = $surat_pengajuan_repair_line_id;
foreach ($q->result() as $r) {
$data['suratpengajuanrepairline__nodiss'] = $r->nodiss;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['suratpengajuanrepairline__item_id'] = $r->item_id;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['suratpengajuanrepairline__customer_id'] = $r->customer_id;
$mesin_opt = array();
$q = $this->db->get('mesin');
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['suratpengajuanrepairline__mesin_id'] = $r->mesin_id;
$data['suratpengajuanrepairline__tipecore'] = $r->tipecore;
$data['suratpengajuanrepairline__rolldiameter'] = $r->rolldiameter;
$data['suratpengajuanrepairline__bearingseatdiameter'] = $r->bearingseatdiameter;
$data['suratpengajuanrepairline__totallength'] = $r->totallength;
$data['suratpengajuanrepairline__quantity'] = $r->quantity;
$data['suratpengajuanrepairline__jenisrepair'] = $r->jenisrepair;
$data['suratpengajuanrepairline__notes'] = $r->notes;
$data['suratpengajuanrepairline__lastupdate'] = $r->lastupdate;
$data['suratpengajuanrepairline__updatedby'] = $r->updatedby;
$data['suratpengajuanrepairline__created'] = $r->created;
$data['suratpengajuanrepairline__createdby'] = $r->createdby;}
$this->load->view('surat_pengajuan_repair_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['nodiss'] = $_POST['suratpengajuanrepairline__nodiss'];
$data['item_id'] = $_POST['suratpengajuanrepairline__item_id'];
$data['customer_id'] = $_POST['suratpengajuanrepairline__customer_id'];
$data['mesin_id'] = $_POST['suratpengajuanrepairline__mesin_id'];
$data['tipecore'] = $_POST['suratpengajuanrepairline__tipecore'];
$data['rolldiameter'] = $_POST['suratpengajuanrepairline__rolldiameter'];
$data['bearingseatdiameter'] = $_POST['suratpengajuanrepairline__bearingseatdiameter'];
$data['totallength'] = $_POST['suratpengajuanrepairline__totallength'];
$data['quantity'] = $_POST['suratpengajuanrepairline__quantity'];
$data['jenisrepair'] = $_POST['suratpengajuanrepairline__jenisrepair'];
$data['notes'] = $_POST['suratpengajuanrepairline__notes'];
$data['lastupdate'] = $_POST['suratpengajuanrepairline__lastupdate'];
$data['updatedby'] = $_POST['suratpengajuanrepairline__updatedby'];
$data['created'] = $_POST['suratpengajuanrepairline__created'];
$data['createdby'] = $_POST['suratpengajuanrepairline__createdby'];
$this->db->where('id', $data['surat_pengajuan_repair_line_id']);
$this->db->update('suratpengajuanrepairline', $data);
			validationonserver();
			
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