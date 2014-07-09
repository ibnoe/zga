<?php

class customerview extends Controller {

	function customerview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($customer_id=0)
	{
		if ($customer_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $customer_id);
$this->db->select('*');
$q = $this->db->get('customer');
if ($q->num_rows() > 0) {
$data = array();
$data['customer_id'] = $customer_id;
foreach ($q->result() as $r) {
$data['customer__idstring'] = $r->idstring;
$data['customer__firstname'] = $r->firstname;
$data['customer__lastname'] = $r->lastname;
$data['customer__address'] = $r->address;
$data['customer__deliveryrecipient'] = $r->deliveryrecipient;
$data['customer__deliveryaddress'] = $r->deliveryaddress;
$data['customer__tax_rate'] = $r->tax_rate;
$data['customer__discount'] = $r->discount;
$data['customer__top'] = $r->top;
$data['customer__phone'] = $r->phone;
$data['customer__fax'] = $r->fax;
$data['customer__npwp'] = $r->npwp;
$data['customer__email'] = $r->email;
$data['customer__website'] = $r->website;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['customer__currency_id'] = $r->currency_id;
$customergroup_opt = array();
$q = $this->db->get('customergroup');
foreach ($q->result() as $row) { $customergroup_opt[$row->id] = $row->name; }
$data['customergroup_opt'] = $customergroup_opt;
$data['customer__customergroup_id'] = $r->customergroup_id;
$marketingofficer_opt = array();
$q = $this->db->get('marketingofficer');
foreach ($q->result() as $row) { $marketingofficer_opt[$row->id] = $row->name; }
$data['marketingofficer_opt'] = $marketingofficer_opt;
$data['customer__marketingofficer_id'] = $r->marketingofficer_id;
$data['customer__status'] = $r->status;
$data['customer__rating'] = $r->rating;
$data['customer__lastupdate'] = $r->lastupdate;
$data['customer__updatedby'] = $r->updatedby;
$data['customer__created'] = $r->created;
$data['customer__createdby'] = $r->createdby;}
$this->load->view('customer_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['customer__idstring'];
$data['firstname'] = $_POST['customer__firstname'];
$data['lastname'] = $_POST['customer__lastname'];
$data['address'] = $_POST['customer__address'];
$data['deliveryrecipient'] = $_POST['customer__deliveryrecipient'];
$data['deliveryaddress'] = $_POST['customer__deliveryaddress'];
$data['tax_rate'] = $_POST['customer__tax_rate'];
$data['discount'] = $_POST['customer__discount'];
$data['top'] = $_POST['customer__top'];
$data['phone'] = $_POST['customer__phone'];
$data['fax'] = $_POST['customer__fax'];
$data['npwp'] = $_POST['customer__npwp'];
$data['email'] = $_POST['customer__email'];
$data['website'] = $_POST['customer__website'];
$data['currency_id'] = $_POST['customer__currency_id'];
$data['customergroup_id'] = $_POST['customer__customergroup_id'];
$data['marketingofficer_id'] = $_POST['customer__marketingofficer_id'];
$data['status'] = $_POST['customer__status'];
$data['rating'] = $_POST['customer__rating'];
$data['lastupdate'] = $_POST['customer__lastupdate'];
$data['updatedby'] = $_POST['customer__updatedby'];
$data['created'] = $_POST['customer__created'];
$data['createdby'] = $_POST['customer__createdby'];
$this->db->where('id', $data['customer_id']);
$this->db->update('customer', $data);
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