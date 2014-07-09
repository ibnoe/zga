<?php

class customermesinedit extends Controller {

	function customermesinedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($customermesin_id=0)
	{
		if ($customermesin_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $customermesin_id);
$this->db->select('*');
$q = $this->db->get('customermesin');
if ($q->num_rows() > 0) {
$data = array();
$data['customermesin_id'] = $customermesin_id;
foreach ($q->result() as $r) {
$mesin_opt = array();
$mesin_opt[''] = 'None';
$q = $this->db->get('mesin');
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['customermesin__mesin_id'] = $r->mesin_id;
$data['customermesin__nomesin'] = $r->nomesin;
$data['customermesin__noserimesin'] = $r->noserimesin;
$data['customermesin__tahun'] = $r->tahun;
$data['customermesin__konfigurasi'] = $r->konfigurasi;
$data['customermesin__jumlahblanket'] = $r->jumlahblanket;
$data['customermesin__jumlahroll'] = $r->jumlahroll;
$data['customermesin__notes'] = $r->notes;
$data['customermesin__lastupdate'] = $r->lastupdate;
$data['customermesin__updatedby'] = $r->updatedby;
$data['customermesin__created'] = $r->created;
$data['customermesin__createdby'] = $r->createdby;}
$this->load->view('customermesin_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['customermesin__mesin_id']) || ($_POST['customermesin__mesin_id'] == "" || $_POST['customermesin__mesin_id'] == null  || $_POST['customermesin__mesin_id'] == 0))
$error .= "<span class='error'>Mesin ID must not be empty"."</span><br>";

if (isset($_POST['customermesin__mesin_id'])) {$this->db->where("id !=", $_POST['customermesin_id']);
$this->db->where('mesin_id', $_POST['customermesin__mesin_id']);
$q = $this->db->get('customermesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>Mesin ID must be unique"."</span><br>";}

if (isset($_POST['customermesin__nomesin']) && ($_POST['customermesin__nomesin'] == "" || $_POST['customermesin__nomesin'] == null))
$error .= "<span class='error'>No Mesin must not be empty"."</span><br>";

if (isset($_POST['customermesin__nomesin'])) {$this->db->where("id !=", $_POST['customermesin_id']);
$this->db->where('nomesin', $_POST['customermesin__nomesin']);
$q = $this->db->get('customermesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Mesin must be unique"."</span><br>";}

if (isset($_POST['customermesin__noserimesin']) && ($_POST['customermesin__noserimesin'] == "" || $_POST['customermesin__noserimesin'] == null))
$error .= "<span class='error'>No Seri Mesin must not be empty"."</span><br>";

if (isset($_POST['customermesin__noserimesin'])) {$this->db->where("id !=", $_POST['customermesin_id']);
$this->db->where('noserimesin', $_POST['customermesin__noserimesin']);
$q = $this->db->get('customermesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Seri Mesin must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['customermesin__mesin_id']))
$data['mesin_id'] = $_POST['customermesin__mesin_id'];if (isset($_POST['customermesin__nomesin']))
$data['nomesin'] = $_POST['customermesin__nomesin'];if (isset($_POST['customermesin__noserimesin']))
$data['noserimesin'] = $_POST['customermesin__noserimesin'];if (isset($_POST['customermesin__tahun']))
$data['tahun'] = $_POST['customermesin__tahun'];if (isset($_POST['customermesin__konfigurasi']))
$data['konfigurasi'] = $_POST['customermesin__konfigurasi'];if (isset($_POST['customermesin__jumlahblanket']))
$data['jumlahblanket'] = $_POST['customermesin__jumlahblanket'];if (isset($_POST['customermesin__jumlahroll']))
$data['jumlahroll'] = $_POST['customermesin__jumlahroll'];if (isset($_POST['customermesin__notes']))
$data['notes'] = $_POST['customermesin__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['customermesin_id']);
$this->db->update('customermesin', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('customermesinedit','customermesin','afteredit', $_POST['customermesin_id']);
			
			
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