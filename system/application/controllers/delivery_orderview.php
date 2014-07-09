<?php

class delivery_orderview extends Controller {

	function delivery_orderview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($delivery_order_id=0)
	{
		if ($delivery_order_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $delivery_order_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$this->db->select('DATE_FORMAT(dodate, "%d-%m-%Y") as dodate', false);
$q = $this->db->get('deliveryorder');
if ($q->num_rows() > 0) {
$data = array();
$data['delivery_order_id'] = $delivery_order_id;
foreach ($q->result() as $r) {
$data['deliveryorder__date'] = $r->date;
$data['deliveryorder__orderid'] = $r->orderid;
$data['deliveryorder__donum'] = $r->donum;
$data['deliveryorder__dodate'] = $r->dodate;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['deliveryorder__customer_id'] = $r->customer_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['deliveryorder__warehouse_id'] = $r->warehouse_id;
$data['deliveryorder__deliveredby'] = $r->deliveredby;
$data['deliveryorder__vehicleno'] = $r->vehicleno;
$data['deliveryorder__notes'] = $r->notes;
$data['deliveryorder__lastupdate'] = $r->lastupdate;
$data['deliveryorder__updatedby'] = $r->updatedby;
$data['deliveryorder__created'] = $r->created;
$data['deliveryorder__createdby'] = $r->createdby;}
$this->load->view('delivery_order_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['deliveryorder__date'];
$data['orderid'] = $_POST['deliveryorder__orderid'];
$data['donum'] = $_POST['deliveryorder__donum'];
$data['dodate'] = $_POST['deliveryorder__dodate'];
$data['customer_id'] = $_POST['deliveryorder__customer_id'];
$data['warehouse_id'] = $_POST['deliveryorder__warehouse_id'];
$data['deliveredby'] = $_POST['deliveryorder__deliveredby'];
$data['vehicleno'] = $_POST['deliveryorder__vehicleno'];
$data['notes'] = $_POST['deliveryorder__notes'];
$data['lastupdate'] = $_POST['deliveryorder__lastupdate'];
$data['updatedby'] = $_POST['deliveryorder__updatedby'];
$data['created'] = $_POST['deliveryorder__created'];
$data['createdby'] = $_POST['deliveryorder__createdby'];
$this->db->where('id', $data['delivery_order_id']);
$this->db->update('deliveryorder', $data);
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