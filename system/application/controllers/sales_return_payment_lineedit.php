<?php

class sales_return_payment_lineedit extends Controller {

	function sales_return_payment_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_payment_line_id=0)
	{
		if ($sales_return_payment_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_return_payment_line_id);
$this->db->select('*');
$q = $this->db->get('salesreturnpaymentline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_payment_line_id'] = $sales_return_payment_line_id;
foreach ($q->result() as $r) {
$salesreturninvoice_opt = array();
$salesreturninvoice_opt[''] = 'None';
$q = $this->db->get('salesreturninvoice');
foreach ($q->result() as $row) { $salesreturninvoice_opt[$row->id] = $row->salesreturninvoiceid; }
$data['salesreturninvoice_opt'] = $salesreturninvoice_opt;
$data['salesreturnpaymentline__salesreturninvoice_id'] = $r->salesreturninvoice_id;
$data['salesreturnpaymentline__lastupdate'] = $r->lastupdate;
$data['salesreturnpaymentline__updatedby'] = $r->updatedby;
$data['salesreturnpaymentline__created'] = $r->created;
$data['salesreturnpaymentline__createdby'] = $r->createdby;}
$this->load->view('sales_return_payment_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturnpaymentline__salesreturninvoice_id']))
$data['salesreturninvoice_id'] = $_POST['salesreturnpaymentline__salesreturninvoice_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_return_payment_line_id']);
$this->db->update('salesreturnpaymentline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_payment_lineedit','salesreturnpaymentline','afteredit', $_POST['sales_return_payment_line_id']);
			
			
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