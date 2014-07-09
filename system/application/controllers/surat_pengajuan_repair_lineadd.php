<?php

class surat_pengajuan_repair_lineadd extends Controller {

	function surat_pengajuan_repair_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['suratpengajuanrepair_id'] = $id;
$data['suratpengajuanrepairline__nodiss'] = '';$this->load->library('generallib');
$data['suratpengajuanrepairline__nodiss'] = $this->generallib->genId('Surat Pengajuan Repair Line');
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['suratpengajuanrepairline__item_id'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['suratpengajuanrepairline__customer_id'] = '';
$mesin_opt = array();
$mesin_opt[''] = 'None';
$q = $this->db->get('mesin');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['suratpengajuanrepairline__mesin_id'] = '';
$data['suratpengajuanrepairline__tipecore'] = '';
$data['suratpengajuanrepairline__rolldiameter'] = '';
$data['suratpengajuanrepairline__bearingseatdiameter'] = '';
$data['suratpengajuanrepairline__totallength'] = '';
$data['suratpengajuanrepairline__quantity'] = '';
$data['suratpengajuanrepairline__jenisrepair'] = '';
$data['suratpengajuanrepairline__notes'] = '';
$data['suratpengajuanrepairline__lastupdate'] = '';
$data['suratpengajuanrepairline__updatedby'] = '';
$data['suratpengajuanrepairline__created'] = '';
$data['suratpengajuanrepairline__createdby'] = '';
$suratpengajuanrepair = array();
$this->db->where('id', $id);
$q = $this->db->get('suratpengajuanrepair');
if ($q->num_rows() > 0)
$suratpengajuanrepair = $q->row_array();
$data['suratpengajuanrepairline__lastupdate'] = $suratpengajuanrepair['lastupdate'];
$data['suratpengajuanrepairline__updatedby'] = $suratpengajuanrepair['updatedby'];
$data['suratpengajuanrepairline__created'] = $suratpengajuanrepair['created'];
$data['suratpengajuanrepairline__createdby'] = $suratpengajuanrepair['createdby'];
		

		$this->load->view('surat_pengajuan_repair_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['suratpengajuanrepairline__nodiss']) && ($_POST['suratpengajuanrepairline__nodiss'] == "" || $_POST['suratpengajuanrepairline__nodiss'] == null))
$error .= "<span class='error'>No Diss must not be empty"."</span><br>";

if (!isset($_POST['suratpengajuanrepairline__item_id']) || ($_POST['suratpengajuanrepairline__item_id'] == "" || $_POST['suratpengajuanrepairline__item_id'] == null  || $_POST['suratpengajuanrepairline__item_id'] == null))
$error .= "<span class='error'>Barang must not be empty"."</span><br>";

if (!isset($_POST['suratpengajuanrepairline__customer_id']) || ($_POST['suratpengajuanrepairline__customer_id'] == "" || $_POST['suratpengajuanrepairline__customer_id'] == null  || $_POST['suratpengajuanrepairline__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (isset($_POST['suratpengajuanrepairline__quantity']) && ($_POST['suratpengajuanrepairline__quantity'] == "" || $_POST['suratpengajuanrepairline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['suratpengajuanrepair_id'] = $_POST['suratpengajuanrepair_id'];if (isset($_POST['suratpengajuanrepairline__nodiss']))
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
$this->db->insert('suratpengajuanrepairline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$suratpengajuanrepairline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('surat_pengajuan_repair_lineadd','suratpengajuanrepairline','aftersave', $suratpengajuanrepairline_id);
			
		
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