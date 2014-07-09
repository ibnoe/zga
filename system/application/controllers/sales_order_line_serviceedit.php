<?php

class sales_order_line_serviceedit extends Controller {

	function sales_order_line_serviceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_order_line_service_id=0)
	{
		if ($sales_order_line_service_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_order_line_service_id);
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_order_line_service_id'] = $sales_order_line_service_id;
foreach ($q->result() as $r) {
$data['salesorderline__orderid'] = $r->orderid;
$data['salesorderline__date'] = $r->date;
$data['salesorderline__notes'] = $r->notes;
$data['salesorderline__customer_id'] = $r->customer_id;
$data['salesorderline__currency_id'] = $r->currency_id;
$data['salesorderline__currencyrate'] = $r->currencyrate;
$data['salesorderline__warehouse_id'] = $r->warehouse_id;
$data['salesorderline__status'] = $r->status;
$rcn_opt = array();
$q = $this->db->get('rcn');
foreach ($q->result() as $row) { $rcn_opt[$row->id] = $row->norcn; }
$data['rcn_opt'] = $rcn_opt;
$data['salesorderline__rcn_id'] = $r->rcn_id;
$data['salesorderline__quantity'] = $r->quantity;
$data['salesorderline__price'] = $r->price;
$data['salesorderline__pdisc'] = $r->pdisc;
$data['salesorderline__subtotal'] = $r->subtotal;
$data['salesorderline__modulename'] = $r->modulename;
$data['salesorderline__lastupdate'] = $r->lastupdate;
$data['salesorderline__updatedby'] = $r->updatedby;
$data['salesorderline__created'] = $r->created;
$data['salesorderline__createdby'] = $r->createdby;}
$this->load->view('sales_order_line_service_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesorderline__orderid']))
$data['orderid'] = $_POST['salesorderline__orderid'];if (isset($_POST['salesorderline__date']))
$data['date'] = $_POST['salesorderline__date'];if (isset($_POST['salesorderline__notes']))
$data['notes'] = $_POST['salesorderline__notes'];if (isset($_POST['salesorderline__customer_id']))
$data['customer_id'] = $_POST['salesorderline__customer_id'];if (isset($_POST['salesorderline__currency_id']))
$data['currency_id'] = $_POST['salesorderline__currency_id'];if (isset($_POST['salesorderline__currencyrate']))
$data['currencyrate'] = $_POST['salesorderline__currencyrate'];if (isset($_POST['salesorderline__warehouse_id']))
$data['warehouse_id'] = $_POST['salesorderline__warehouse_id'];if (isset($_POST['salesorderline__status']))
$data['status'] = $_POST['salesorderline__status'];if (isset($_POST['salesorderline__rcn_id']))
$data['rcn_id'] = $_POST['salesorderline__rcn_id'];if (isset($_POST['salesorderline__quantity']))
$data['quantity'] = $_POST['salesorderline__quantity'];if (isset($_POST['salesorderline__price']))
$data['price'] = $_POST['salesorderline__price'];if (isset($_POST['salesorderline__pdisc']))
$data['pdisc'] = $_POST['salesorderline__pdisc'];if (isset($_POST['salesorderline__subtotal']))
$data['subtotal'] = $_POST['salesorderline__subtotal'];if (isset($_POST['salesorderline__modulename']))
$data['modulename'] = $_POST['salesorderline__modulename'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_order_line_service_id']);
$this->db->update('salesorderline', $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sales_order_line_serviceedit','salesorderline','aftersave');
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>