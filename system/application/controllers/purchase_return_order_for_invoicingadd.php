<?php

class purchase_return_order_for_invoicingadd extends Controller {

	function purchase_return_order_for_invoicingadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasereturnorderline__lastupdate'] = '';
$data['purchasereturnorderline__updatedby'] = '';
$data['purchasereturnorderline__created'] = '';
$data['purchasereturnorderline__createdby'] = '';
		

		$this->load->view('purchase_return_order_for_invoicing_add_form', $data);
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
$this->db->insert('purchasereturnorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturnorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_return_order_for_invoicingadd','purchasereturnorderline','aftersave', $purchasereturnorderline_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('purchasereturnorderline__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_order_for_invoicingadd','purchasereturnorderline','validation', 0, $valdata);
		
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