<?php

class purchase_return_payment_lineadd extends Controller {

	function purchase_return_payment_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$purchasereturninvoice_opt = array();
$purchasereturninvoice_opt[''] = 'None';
$q = $this->db->get('purchasereturninvoice');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchasereturninvoice_opt[$row->id] = $row->purchasereturninvoiceid; }
$data['purchasereturninvoice_opt'] = $purchasereturninvoice_opt;
$data['purchasereturnpaymentline__purchasereturninvoice_id'] = '';
$data['purchasereturnpaymentline__lastupdate'] = '';
$data['purchasereturnpaymentline__updatedby'] = '';
$data['purchasereturnpaymentline__created'] = '';
$data['purchasereturnpaymentline__createdby'] = '';
		

		$this->load->view('purchase_return_payment_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturnpaymentline__purchasereturninvoice_id']))
$data['purchasereturninvoice_id'] = $_POST['purchasereturnpaymentline__purchasereturninvoice_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturnpaymentline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturnpaymentline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_payment_lineadd','purchasereturnpaymentline','aftersave', $purchasereturnpaymentline_id);
			
		
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