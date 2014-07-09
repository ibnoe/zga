<?php

class open_sales_order_for_invoicingadd extends Controller {

	function open_sales_order_for_invoicingadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesorderline__subtotal'] = '';
$data['salesorderline__lastupdate'] = '';
$data['salesorderline__updatedby'] = '';
$data['salesorderline__created'] = '';
$data['salesorderline__createdby'] = '';
		

		$this->load->view('open_sales_order_for_invoicing_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesorderline__subtotal']))
$data['subtotal'] = $_POST['salesorderline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('open_sales_order_for_invoicingadd','salesorderline','aftersave', $salesorderline_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('salesorderline__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_sales_order_for_invoicingadd','salesorderline','validation', 0, $valdata);
		
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