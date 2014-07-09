<?php

class surat_pengajuan_repair_lineedit extends Controller {

	function surat_pengajuan_repair_lineedit()
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
	
		
$q = $this->db->where('id', $surat_pengajuan_repair_line_id);
$this->db->select('*');
$q = $this->db->get('suratpengajuanrepairline');
if ($q->num_rows() > 0) {
$data = array();
$data['surat_pengajuan_repair_line_id'] = $surat_pengajuan_repair_line_id;
foreach ($q->result() as $r) {
$data['suratpengajuanrepairline__nodiss'] = $r->nodiss;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['suratpengajuanrepairline__item_id'] = $r->item_id;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['suratpengajuanrepairline__customer_id'] = $r->customer_id;
$mesin_opt = array();
$mesin_opt[''] = 'None';
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
$this->load->view('surat_pengajuan_repair_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['suratpengajuanrepairline__nodiss']) && ($_POST['suratpengajuanrepairline__nodiss'] == "" || $_POST['suratpengajuanrepairline__nodiss'] == null))
$error .= "<span class='error'>No Diss must not be empty"."</span><br>";

if (!isset($_POST['suratpengajuanrepairline__item_id']) || ($_POST['suratpengajuanrepairline__item_id'] == "" || $_POST['suratpengajuanrepairline__item_id'] == null  || $_POST['suratpengajuanrepairline__item_id'] == 0))
$error .= "<span class='error'>Barang must not be empty"."</span><br>";

if (!isset($_POST['suratpengajuanrepairline__customer_id']) || ($_POST['suratpengajuanrepairline__customer_id'] == "" || $_POST['suratpengajuanrepairline__customer_id'] == null  || $_POST['suratpengajuanrepairline__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (isset($_POST['suratpengajuanrepairline__quantity']) && ($_POST['suratpengajuanrepairline__quantity'] == "" || $_POST['suratpengajuanrepairline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['suratpengajuanrepairline__nodiss']))
$data['nodiss'] = $_POST['suratpengajuanrepairline__nodiss'];if (isset($_POST['suratpengajuanrepairline__item_id']))
$data['item_id'] = $_POST['suratpengajuanrepairline__item_id'];if (isset($_POST['suratpengajuanrepairline__customer_id']))
$data['customer_id'] = $_POST['suratpengajuanrepairline__customer_id'];if (isset($_POST['suratpengajuanrepairline__mesin_id']))
$data['mesin_id'] = $_POST['suratpengajuanrepairline__mesin_id'];if (isset($_POST['suratpengajuanrepairline__tipecore']))
$data['tipecore'] = $_POST['suratpengajuanrepairline__tipecore'];if (isset($_POST['suratpengajuanrepairline__rolldiameter']))
$data['rolldiameter'] = $_POST['suratpengajuanrepairline__rolldiameter'];if (isset($_POST['suratpengajuanrepairline__bearingseatdiameter']))
$data['bearingseatdiameter'] = $_POST['suratpengajuanrepairline__bearingseatdiameter'];if (isset($_POST['suratpengajuanrepairline__totallength']))
$data['totallength'] = $_POST['suratpengajuanrepairline__totallength'];if (isset($_POST['suratpengajuanrepairline__quantity']))
$data['quantity'] = $_POST['suratpengajuanrepairline__quantity'];if (isset($_POST['suratpengajuanrepairline__jenisrepair']))
$data['jenisrepair'] = $_POST['suratpengajuanrepairline__jenisrepair'];if (isset($_POST['suratpengajuanrepairline__notes']))
$data['notes'] = $_POST['suratpengajuanrepairline__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['surat_pengajuan_repair_line_id']);
$this->db->update('suratpengajuanrepairline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('surat_pengajuan_repair_lineedit','suratpengajuanrepairline','afteredit', $_POST['surat_pengajuan_repair_line_id']);
			
			
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