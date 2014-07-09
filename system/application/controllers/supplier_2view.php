<?php

class supplier_2view extends Controller {

	function supplier_2view()
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
	
		
$this->db->where('id', $supplier_2_id);
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
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['supplier__currency_id'] = $r->currency_id;
$data['supplier__rating'] = $r->rating;
$data['supplier__lastupdate'] = $r->lastupdate;
$data['supplier__updatedby'] = $r->updatedby;
$data['supplier__created'] = $r->created;
$data['supplier__createdby'] = $r->createdby;}
$this->load->view('supplier_2_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['supplier__idstring'];
$data['firstname'] = $_POST['supplier__firstname'];
$data['lastname'] = $_POST['supplier__lastname'];
$data['address'] = $_POST['supplier__address'];
$data['phone'] = $_POST['supplier__phone'];
$data['fax'] = $_POST['supplier__fax'];
$data['npwp'] = $_POST['supplier__npwp'];
$data['email'] = $_POST['supplier__email'];
$data['firmtype'] = $_POST['supplier__firmtype'];
$data['contactperson'] = $_POST['supplier__contactperson'];
$data['hpcontactperson'] = $_POST['supplier__hpcontactperson'];
$data['barang'] = $_POST['supplier__barang'];
$data['top'] = $_POST['supplier__top'];
$data['currency_id'] = $_POST['supplier__currency_id'];
$data['rating'] = $_POST['supplier__rating'];
$data['lastupdate'] = $_POST['supplier__lastupdate'];
$data['updatedby'] = $_POST['supplier__updatedby'];
$data['created'] = $_POST['supplier__created'];
$data['createdby'] = $_POST['supplier__createdby'];
$this->db->where('id', $data['supplier_2_id']);
$this->db->update('supplier', $data);
			validationonserver();
			
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