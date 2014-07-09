<?php

class price_listadd extends Controller {

	function price_listadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['customer_id'] = $id;
$data['pricelist__idstring'] = '';$this->load->library('generallib');
$data['pricelist__idstring'] = $this->generallib->genId('Price List');
$data['pricelist__name'] = '';
$data['pricelist__lastupdate'] = '';
$data['pricelist__updatedby'] = '';
$data['pricelist__created'] = '';
$data['pricelist__createdby'] = '';
$customer = array();
$this->db->where('id', $id);
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
$customer = $q->row_array();
$data['pricelist__idstring'] = $customer['idstring'];
$data['pricelist__lastupdate'] = $customer['lastupdate'];
$data['pricelist__updatedby'] = $customer['updatedby'];
$data['pricelist__created'] = $customer['created'];
$data['pricelist__createdby'] = $customer['createdby'];
		

		$this->load->view('price_list_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['pricelist__idstring']) && ($_POST['pricelist__idstring'] == "" || $_POST['pricelist__idstring'] == null))
$error .= "<span class='error'>Pricelist ID must not be empty"."</span><br>";

if (isset($_POST['pricelist__idstring'])) {
$this->db->where('idstring', $_POST['pricelist__idstring']);
$q = $this->db->get('pricelist');
if ($q->num_rows() > 0) $error .= "<span class='error'>Pricelist ID must be unique"."</span><br>";}

if (isset($_POST['pricelist__name']) && ($_POST['pricelist__name'] == "" || $_POST['pricelist__name'] == null))
$error .= "<span class='error'>Pricelist Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['customer_id'] = $_POST['customer_id'];if (isset($_POST['pricelist__idstring']))
$data['idstring'] = $_POST['pricelist__idstring'];if (isset($_POST['pricelist__name']))
$data['name'] = $_POST['pricelist__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('pricelist', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$pricelist_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('price_listadd','pricelist','aftersave', $pricelist_id);
			
		
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