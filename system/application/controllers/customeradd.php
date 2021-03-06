<?php

class customeradd extends Controller {

	function customeradd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['customer__idstring'] = '';$this->load->library('generallib');
$data['customer__idstring'] = $this->generallib->genId('Customer');
$data['customer__firstname'] = '';
$data['customer__lastname'] = '';
$data['customer__address'] = '';
$data['customer__deliveryrecipient'] = '';
$data['customer__deliveryaddress'] = '';
$data['customer__tax_rate'] = '';
$data['customer__discount'] = '';
$data['customer__top'] = '';
$data['customer__phone'] = '';
$data['customer__fax'] = '';
$data['customer__npwp'] = 'None';
$data['customer__email'] = '';
$data['customer__website'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['customer__currency_id'] = '';
$customergroup_opt = array();
$customergroup_opt[''] = 'None';
$q = $this->db->get('customergroup');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customergroup_opt[$row->id] = $row->name; }
$data['customergroup_opt'] = $customergroup_opt;
$data['customer__customergroup_id'] = '';
$marketingofficer_opt = array();
$marketingofficer_opt[''] = 'None';
$q = $this->db->get('marketingofficer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $marketingofficer_opt[$row->id] = $row->name; }
$data['marketingofficer_opt'] = $marketingofficer_opt;
$data['customer__marketingofficer_id'] = '';
$data['customer__status'] = '';
$data['customer__rating'] = '';
$data['customer__lastupdate'] = '';
$data['customer__updatedby'] = '';
$data['customer__created'] = '';
$data['customer__createdby'] = '';
		

		$this->load->view('customer_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['customer__idstring']) && ($_POST['customer__idstring'] == "" || $_POST['customer__idstring'] == null))
$error .= "<span class='error'>Customer ID must not be empty"."</span><br>";

if (isset($_POST['customer__idstring'])) {
$this->db->where('idstring', $_POST['customer__idstring']);
$q = $this->db->get('customer');
if ($q->num_rows() > 0) $error .= "<span class='error'>Customer ID must be unique"."</span><br>";}

if (isset($_POST['customer__firstname']) && ($_POST['customer__firstname'] == "" || $_POST['customer__firstname'] == null))
$error .= "<span class='error'>First Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['customer__idstring']))
$data['idstring'] = $_POST['customer__idstring'];if (isset($_POST['customer__firstname']))
$data['firstname'] = $_POST['customer__firstname'];if (isset($_POST['customer__lastname']))
$data['lastname'] = $_POST['customer__lastname'];if (isset($_POST['customer__address']))
$data['address'] = $_POST['customer__address'];if (isset($_POST['customer__deliveryrecipient']))
$data['deliveryrecipient'] = $_POST['customer__deliveryrecipient'];if (isset($_POST['customer__deliveryaddress']))
$data['deliveryaddress'] = $_POST['customer__deliveryaddress'];if (isset($_POST['customer__tax_rate']))
$data['tax_rate'] = $_POST['customer__tax_rate'];if (isset($_POST['customer__discount']))
$data['discount'] = $_POST['customer__discount'];if (isset($_POST['customer__top']))
$data['top'] = $_POST['customer__top'];if (isset($_POST['customer__phone']))
$data['phone'] = $_POST['customer__phone'];if (isset($_POST['customer__fax']))
$data['fax'] = $_POST['customer__fax'];if (isset($_POST['customer__npwp']))
$data['npwp'] = $_POST['customer__npwp'];if (isset($_POST['customer__email']))
$data['email'] = $_POST['customer__email'];if (isset($_POST['customer__website']))
$data['website'] = $_POST['customer__website'];if (isset($_POST['customer__currency_id']))
$data['currency_id'] = $_POST['customer__currency_id'];if (isset($_POST['customer__customergroup_id']))
$data['customergroup_id'] = $_POST['customer__customergroup_id'];if (isset($_POST['customer__marketingofficer_id']))
$data['marketingofficer_id'] = $_POST['customer__marketingofficer_id'];if (isset($_POST['customer__status']))
$data['status'] = $_POST['customer__status'];if (isset($_POST['customer__rating']))
$data['rating'] = $_POST['customer__rating'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('customer', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$customer_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('customeradd','customer','aftersave', $customer_id);
			
		
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