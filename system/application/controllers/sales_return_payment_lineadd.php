<?php

class sales_return_payment_lineadd extends Controller {

	function sales_return_payment_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$salesreturninvoice_opt = array();
$salesreturninvoice_opt[''] = 'None';
$q = $this->db->get('salesreturninvoice');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesreturninvoice_opt[$row->id] = $row->salesreturninvoiceid; }
$data['salesreturninvoice_opt'] = $salesreturninvoice_opt;
$data['salesreturnpaymentline__salesreturninvoice_id'] = '';
$data['salesreturnpaymentline__lastupdate'] = '';
$data['salesreturnpaymentline__updatedby'] = '';
$data['salesreturnpaymentline__created'] = '';
$data['salesreturnpaymentline__createdby'] = '';
		

		$this->load->view('sales_return_payment_line_add_form', $data);
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
$this->db->insert('salesreturnpaymentline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturnpaymentline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_payment_lineadd','salesreturnpaymentline','aftersave', $salesreturnpaymentline_id);
			
		
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