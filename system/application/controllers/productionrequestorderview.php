<?php

class productionrequestorderview extends Controller {

	function productionrequestorderview()
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
	
		
$this->db->where('id', $productionrequestorder_id);
$this->db->select('*');
$q = $this->db->get('productionrequestorder');
if ($q->num_rows() > 0) {
$data = array();
$data['productionrequestorder_id'] = $productionrequestorder_id;
foreach ($q->result() as $r) {
$data['productionrequestorder__idstring'] = $r->idstring;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['productionrequestorder__customer_id'] = $r->customer_id;
$data['productionrequestorder__idstring'] = $r->idstring;
$data['productionrequestorder__lastupdate'] = $r->lastupdate;
$data['productionrequestorder__updatedby'] = $r->updatedby;
$data['productionrequestorder__created'] = $r->created;
$data['productionrequestorder__createdby'] = $r->createdby;}
$this->load->view('productionrequestorder_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['productionrequestorder__idstring'];
$data['customer_id'] = $_POST['productionrequestorder__customer_id'];
$data['idstring'] = $_POST['productionrequestorder__idstring'];
$data['lastupdate'] = $_POST['productionrequestorder__lastupdate'];
$data['updatedby'] = $_POST['productionrequestorder__updatedby'];
$data['created'] = $_POST['productionrequestorder__created'];
$data['createdby'] = $_POST['productionrequestorder__createdby'];
$this->db->where('id', $data['productionrequestorder_id']);
$this->db->update('productionrequestorder', $data);
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