<?php

class open_sales_invoice_for_paymentadd extends Controller {

	function open_sales_invoice_for_paymentadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesinvoice__lastupdate'] = '';
$data['salesinvoice__updatedby'] = '';
$data['salesinvoice__created'] = '';
$data['salesinvoice__createdby'] = '';
		

		$this->load->view('open_sales_invoice_for_payment_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesinvoice', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesinvoice_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_sales_invoice_for_paymentadd','salesinvoice','aftersave', $salesinvoice_id);
			
		
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