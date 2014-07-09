<?php

class sales_return_for_invoicingadd extends Controller {

	function sales_return_for_invoicingadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesreturnorderline__lastupdate'] = '';
$data['salesreturnorderline__updatedby'] = '';
$data['salesreturnorderline__created'] = '';
$data['salesreturnorderline__createdby'] = '';
		

		$this->load->view('sales_return_for_invoicing_add_form', $data);
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
$this->db->insert('salesreturnorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturnorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('sales_return_for_invoicingadd','salesreturnorderline','aftersave', $salesreturnorderline_id);
			
$valdata = array();
foreach ($_POST as $k=>$v) {
$idx = str_replace('salesreturnorderline__', '', $k);
if ($v != null)
$valdata[$idx] = $v;
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_for_invoicingadd','salesreturnorderline','validation', 0, $valdata);
		
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