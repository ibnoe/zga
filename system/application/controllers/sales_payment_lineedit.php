<?php

class sales_payment_lineedit extends Controller {

	function sales_payment_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_payment_line_id=0)
	{
		if ($sales_payment_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_payment_line_id);
$this->db->select('*');
$q = $this->db->get('salespaymentline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_payment_line_id'] = $sales_payment_line_id;
foreach ($q->result() as $r) {
$salesinvoice_opt = array();
$salesinvoice_opt[''] = 'None';
$q = $this->db->get('salesinvoice');
foreach ($q->result() as $row) { $salesinvoice_opt[$row->id] = $row->orderid; }
$data['salesinvoice_opt'] = $salesinvoice_opt;
$data['salespaymentline__salesinvoice_id'] = $r->salesinvoice_id;
$data['salespaymentline__lastupdate'] = $r->lastupdate;
$data['salespaymentline__updatedby'] = $r->updatedby;
$data['salespaymentline__created'] = $r->created;
$data['salespaymentline__createdby'] = $r->createdby;}
$this->load->view('sales_payment_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salespaymentline__salesinvoice_id']))
$data['salesinvoice_id'] = $_POST['salespaymentline__salesinvoice_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_payment_line_id']);
$this->db->update('salespaymentline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_payment_lineedit','salespaymentline','afteredit', $_POST['sales_payment_line_id']);
			
			
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