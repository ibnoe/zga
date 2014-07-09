<?php

class sales_payment_lineadd extends Controller {

	function sales_payment_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$salesinvoice_opt = array();
$salesinvoice_opt[''] = 'None';
$q = $this->db->get('salesinvoice');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesinvoice_opt[$row->id] = $row->orderid; }
$data['salesinvoice_opt'] = $salesinvoice_opt;
$data['salespaymentline__salesinvoice_id'] = '';
$data['salespaymentline__lastupdate'] = '';
$data['salespaymentline__updatedby'] = '';
$data['salespaymentline__created'] = '';
$data['salespaymentline__createdby'] = '';
		

		$this->load->view('sales_payment_line_add_form', $data);
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
$this->db->insert('salespaymentline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salespaymentline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_payment_lineadd','salespaymentline','aftersave', $salespaymentline_id);
			
		
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