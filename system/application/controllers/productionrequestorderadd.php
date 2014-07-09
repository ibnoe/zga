<?php

class productionrequestorderadd extends Controller {

	function productionrequestorderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['productionrequestorder__idstring'] = '';$this->load->library('generallib');
$data['productionrequestorder__idstring'] = $this->generallib->genId('ProductionRequestOrder');
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['productionrequestorder__customer_id'] = '';
$data['productionrequestorder__idstring'] = '';$this->load->library('generallib');
$data['productionrequestorder__idstring'] = $this->generallib->genId('ProductionRequestOrder');
$data['productionrequestorder__lastupdate'] = '';
$data['productionrequestorder__updatedby'] = '';
$data['productionrequestorder__created'] = '';
$data['productionrequestorder__createdby'] = '';
		

		$this->load->view('productionrequestorder_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['productionrequestorder__idstring']) && ($_POST['productionrequestorder__idstring'] == "" || $_POST['productionrequestorder__idstring'] == null))
$error .= "<span class='error'>Order No must not be empty"."</span><br>";

if (isset($_POST['productionrequestorder__idstring'])) {
$this->db->where('idstring', $_POST['productionrequestorder__idstring']);
$q = $this->db->get('productionrequestorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order No must be unique"."</span><br>";}

if (!isset($_POST['productionrequestorder__customer_id']) || ($_POST['productionrequestorder__customer_id'] == "" || $_POST['productionrequestorder__customer_id'] == null  || $_POST['productionrequestorder__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (isset($_POST['productionrequestorder__idstring']) && ($_POST['productionrequestorder__idstring'] == "" || $_POST['productionrequestorder__idstring'] == null))
$error .= "<span class='error'>Order No must not be empty"."</span><br>";

if (isset($_POST['productionrequestorder__idstring'])) {
$this->db->where('idstring', $_POST['productionrequestorder__idstring']);
$q = $this->db->get('productionrequestorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order No must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['productionrequestorder__idstring']))
$data['idstring'] = $_POST['productionrequestorder__idstring'];if (isset($_POST['productionrequestorder__customer_id']))
$data['customer_id'] = $_POST['productionrequestorder__customer_id'];if (isset($_POST['productionrequestorder__idstring']))
$data['idstring'] = $_POST['productionrequestorder__idstring'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('productionrequestorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$productionrequestorder_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('productionrequestorderadd','productionrequestorder','aftersave', $productionrequestorder_id);
			
		
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