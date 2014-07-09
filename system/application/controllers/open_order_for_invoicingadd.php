<?php

class open_order_for_invoicingadd extends Controller {

	function open_order_for_invoicingadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchaseorderline__subtotal'] = '';
$data['purchaseorderline__lastupdate'] = '';
$data['purchaseorderline__updatedby'] = '';
$data['purchaseorderline__created'] = '';
$data['purchaseorderline__createdby'] = '';
		

		$this->load->view('open_order_for_invoicing_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchaseorderline__subtotal']))
$data['subtotal'] = $_POST['purchaseorderline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchaseorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchaseorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('open_order_for_invoicingadd','purchaseorderline','aftersave', $purchaseorderline_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('purchaseorderline__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_order_for_invoicingadd','purchaseorderline','validation', 0, $valdata);
		
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