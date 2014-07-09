<?php

class open_sales_order_for_invoicingedit extends Controller {

	function open_sales_order_for_invoicingedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_sales_order_for_invoicing_id=0)
	{
		if ($open_sales_order_for_invoicing_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $open_sales_order_for_invoicing_id);
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['open_sales_order_for_invoicing_id'] = $open_sales_order_for_invoicing_id;
foreach ($q->result() as $r) {
$data['salesorderline__lastupdate'] = $r->lastupdate;
$data['salesorderline__updatedby'] = $r->updatedby;
$data['salesorderline__created'] = $r->created;
$data['salesorderline__createdby'] = $r->createdby;}
$this->load->view('open_sales_order_for_invoicing_edit_form', $data);
}
		

		
		
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
$this->db->where('id', $_POST['open_sales_order_for_invoicing_id']);
$this->db->update('salesorderline', $data);
$this->load->library('generallib');
$this->generallib->commonfunction('open_sales_order_for_invoicingedit','salesorderline','afteredit', $_POST['open_sales_order_for_invoicing_id']);
			
			
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