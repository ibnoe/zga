<?php

class supplier_3add extends Controller {

	function supplier_3add()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['supplier__idstring'] = '';$this->load->library('generallib');
$data['supplier__idstring'] = $this->generallib->genId('Supplier 3');
$data['supplier__firstname'] = '';
$data['supplier__lastname'] = '';
$data['supplier__address'] = '';
$data['supplier__phone'] = '';
$data['supplier__fax'] = '';
$data['supplier__npwp'] = 'None';
$data['supplier__email'] = '';
$data['supplier__firmtype'] = '';
$data['supplier__contactperson'] = '';
$data['supplier__hpcontactperson'] = '';
$data['supplier__barang'] = '';
$data['supplier__top'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['supplier__currency_id'] = '';
$data['supplier__rating'] = '';
$data['supplier__lastupdate'] = '';
$data['supplier__updatedby'] = '';
$data['supplier__created'] = '';
$data['supplier__createdby'] = '';
		

		$this->load->view('supplier_3_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['supplier__idstring']) && ($_POST['supplier__idstring'] == "" || $_POST['supplier__idstring'] == null))
$error .= "<span class='error'>Supplier ID must not be empty"."</span><br>";

if (isset($_POST['supplier__idstring'])) {
$this->db->where('idstring', $_POST['supplier__idstring']);
$q = $this->db->get('supplier');
if ($q->num_rows() > 0) $error .= "<span class='error'>Supplier ID must be unique"."</span><br>";}

if (isset($_POST['supplier__firstname']) && ($_POST['supplier__firstname'] == "" || $_POST['supplier__firstname'] == null))
$error .= "<span class='error'>First Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['supplier__idstring']))
$data['idstring'] = $_POST['supplier__idstring'];if (isset($_POST['supplier__firstname']))
$data['firstname'] = $_POST['supplier__firstname'];if (isset($_POST['supplier__lastname']))
$data['lastname'] = $_POST['supplier__lastname'];if (isset($_POST['supplier__address']))
$data['address'] = $_POST['supplier__address'];if (isset($_POST['supplier__phone']))
$data['phone'] = $_POST['supplier__phone'];if (isset($_POST['supplier__fax']))
$data['fax'] = $_POST['supplier__fax'];if (isset($_POST['supplier__npwp']))
$data['npwp'] = $_POST['supplier__npwp'];if (isset($_POST['supplier__email']))
$data['email'] = $_POST['supplier__email'];if (isset($_POST['supplier__firmtype']))
$data['firmtype'] = $_POST['supplier__firmtype'];if (isset($_POST['supplier__contactperson']))
$data['contactperson'] = $_POST['supplier__contactperson'];if (isset($_POST['supplier__hpcontactperson']))
$data['hpcontactperson'] = $_POST['supplier__hpcontactperson'];if (isset($_POST['supplier__barang']))
$data['barang'] = $_POST['supplier__barang'];if (isset($_POST['supplier__top']))
$data['top'] = $_POST['supplier__top'];if (isset($_POST['supplier__currency_id']))
$data['currency_id'] = $_POST['supplier__currency_id'];if (isset($_POST['supplier__rating']))
$data['rating'] = $_POST['supplier__rating'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('supplier', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$supplier_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('supplier_3add','supplier','aftersave', $supplier_id);
			
		
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