<?php

class supplier_2edit extends Controller {

	function supplier_2edit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($supplier_2_id=0)
	{
		if ($supplier_2_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $supplier_2_id);
$this->db->select('*');
$q = $this->db->get('supplier');
if ($q->num_rows() > 0) {
$data = array();
$data['supplier_2_id'] = $supplier_2_id;
foreach ($q->result() as $r) {
$data['supplier__idstring'] = $r->idstring;
$data['supplier__firstname'] = $r->firstname;
$data['supplier__lastname'] = $r->lastname;
$data['supplier__address'] = $r->address;
$data['supplier__phone'] = $r->phone;
$data['supplier__fax'] = $r->fax;
$data['supplier__npwp'] = $r->npwp;
$data['supplier__email'] = $r->email;
$data['supplier__firmtype'] = $r->firmtype;
$data['supplier__contactperson'] = $r->contactperson;
$data['supplier__hpcontactperson'] = $r->hpcontactperson;
$data['supplier__barang'] = $r->barang;
$data['supplier__top'] = $r->top;
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['supplier__currency_id'] = $r->currency_id;
$data['supplier__rating'] = $r->rating;
$data['supplier__lastupdate'] = $r->lastupdate;
$data['supplier__updatedby'] = $r->updatedby;
$data['supplier__created'] = $r->created;
$data['supplier__createdby'] = $r->createdby;}
$this->load->view('supplier_2_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['supplier__idstring']) && ($_POST['supplier__idstring'] == "" || $_POST['supplier__idstring'] == null))
$error .= "<span class='error'>Supplier ID must not be empty"."</span><br>";

if (isset($_POST['supplier__idstring'])) {$this->db->where("id !=", $_POST['supplier_2_id']);
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
$this->db->where('id', $_POST['supplier_2_id']);
$this->db->update('supplier', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('supplier_2edit','supplier','afteredit', $_POST['supplier_2_id']);
			
			
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