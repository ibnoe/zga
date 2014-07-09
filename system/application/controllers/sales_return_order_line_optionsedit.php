<?php

class sales_return_order_line_optionsedit extends Controller {

	function sales_return_order_line_optionsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_order_line_options_id=0)
	{
		if ($sales_return_order_line_options_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_return_order_line_options_id);
$this->db->select('*');
$q = $this->db->get('salesreturnorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_order_line_options_id'] = $sales_return_order_line_options_id;
foreach ($q->result() as $r) {
$data['salesreturnorderline__lastupdate'] = $r->lastupdate;
$data['salesreturnorderline__updatedby'] = $r->updatedby;
$data['salesreturnorderline__created'] = $r->created;
$data['salesreturnorderline__createdby'] = $r->createdby;}
$this->load->view('sales_return_order_line_options_edit_form', $data);
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
$this->db->where('id', $_POST['sales_return_order_line_options_id']);
$this->db->update('salesreturnorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_order_line_optionsedit','salesreturnorderline','afteredit', $_POST['sales_return_order_line_options_id']);
			
			
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