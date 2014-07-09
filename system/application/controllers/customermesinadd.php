<?php

class customermesinadd extends Controller {

	function customermesinadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['customer_id'] = $id;
$mesin_opt = array();
$mesin_opt[''] = 'None';
$q = $this->db->get('mesin');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['customermesin__mesin_id'] = '';$this->load->library('generallib');
$data['customermesin__mesin_id'] = $this->generallib->genId('CustomerMesin');
$data['customermesin__nomesin'] = '';$this->load->library('generallib');
$data['customermesin__nomesin'] = $this->generallib->genId('CustomerMesin');
$data['customermesin__noserimesin'] = '';$this->load->library('generallib');
$data['customermesin__noserimesin'] = $this->generallib->genId('CustomerMesin');
$data['customermesin__tahun'] = '';
$data['customermesin__konfigurasi'] = '';
$data['customermesin__jumlahblanket'] = '';
$data['customermesin__jumlahroll'] = '';
$data['customermesin__notes'] = '';
$data['customermesin__lastupdate'] = '';
$data['customermesin__updatedby'] = '';
$data['customermesin__created'] = '';
$data['customermesin__createdby'] = '';
$customer = array();
$this->db->where('id', $id);
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
$customer = $q->row_array();
$data['customermesin__lastupdate'] = $customer['lastupdate'];
$data['customermesin__updatedby'] = $customer['updatedby'];
$data['customermesin__created'] = $customer['created'];
$data['customermesin__createdby'] = $customer['createdby'];
		

		$this->load->view('customermesin_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['customermesin__mesin_id']) || ($_POST['customermesin__mesin_id'] == "" || $_POST['customermesin__mesin_id'] == null  || $_POST['customermesin__mesin_id'] == null))
$error .= "<span class='error'>Mesin ID must not be empty"."</span><br>";

if (isset($_POST['customermesin__mesin_id'])) {
$this->db->where('mesin_id', $_POST['customermesin__mesin_id']);
$q = $this->db->get('customermesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>Mesin ID must be unique"."</span><br>";}

if (isset($_POST['customermesin__nomesin']) && ($_POST['customermesin__nomesin'] == "" || $_POST['customermesin__nomesin'] == null))
$error .= "<span class='error'>No Mesin must not be empty"."</span><br>";

if (isset($_POST['customermesin__nomesin'])) {
$this->db->where('nomesin', $_POST['customermesin__nomesin']);
$q = $this->db->get('customermesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Mesin must be unique"."</span><br>";}

if (isset($_POST['customermesin__noserimesin']) && ($_POST['customermesin__noserimesin'] == "" || $_POST['customermesin__noserimesin'] == null))
$error .= "<span class='error'>No Seri Mesin must not be empty"."</span><br>";

if (isset($_POST['customermesin__noserimesin'])) {
$this->db->where('noserimesin', $_POST['customermesin__noserimesin']);
$q = $this->db->get('customermesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Seri Mesin must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();
$data['customer_id'] = $_POST['customer_id'];if (isset($_POST['customermesin__mesin_id']))
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
$this->db->insert('customermesin', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$customermesin_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('customermesinadd','customermesin','aftersave', $customermesin_id);
			
		
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