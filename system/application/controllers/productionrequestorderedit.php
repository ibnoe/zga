<?php

class productionrequestorderedit extends Controller {

	function productionrequestorderedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($productionrequestorder_id=0)
	{
		if ($productionrequestorder_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $productionrequestorder_id);
$this->db->select('*');
$q = $this->db->get('productionrequestorder');
if ($q->num_rows() > 0) {
$data = array();
$data['productionrequestorder_id'] = $productionrequestorder_id;
foreach ($q->result() as $r) {
$data['productionrequestorder__idstring'] = $r->idstring;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['productionrequestorder__customer_id'] = $r->customer_id;
$data['productionrequestorder__idstring'] = $r->idstring;
$data['productionrequestorder__lastupdate'] = $r->lastupdate;
$data['productionrequestorder__updatedby'] = $r->updatedby;
$data['productionrequestorder__created'] = $r->created;
$data['productionrequestorder__createdby'] = $r->createdby;}
$this->load->view('productionrequestorder_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['productionrequestorder__idstring']) && ($_POST['productionrequestorder__idstring'] == "" || $_POST['productionrequestorder__idstring'] == null))
$error .= "<span class='error'>Order No must not be empty"."</span><br>";

if (isset($_POST['productionrequestorder__idstring'])) {$this->db->where("id !=", $_POST['productionrequestorder_id']);
$this->db->where('idstring', $_POST['productionrequestorder__idstring']);
$q = $this->db->get('productionrequestorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order No must be unique"."</span><br>";}

if (!isset($_POST['productionrequestorder__customer_id']) || ($_POST['productionrequestorder__customer_id'] == "" || $_POST['productionrequestorder__customer_id'] == null  || $_POST['productionrequestorder__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (isset($_POST['productionrequestorder__idstring']) && ($_POST['productionrequestorder__idstring'] == "" || $_POST['productionrequestorder__idstring'] == null))
$error .= "<span class='error'>Order No must not be empty"."</span><br>";

if (isset($_POST['productionrequestorder__idstring'])) {$this->db->where("id !=", $_POST['productionrequestorder_id']);
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
$this->db->where('id', $_POST['productionrequestorder_id']);
$this->db->update('productionrequestorder', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('productionrequestorderedit','productionrequestorder','afteredit', $_POST['productionrequestorder_id']);
			
			
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