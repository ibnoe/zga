<?php

class sales_return_order_line_optionsview extends Controller {

	function sales_return_order_line_optionsview()
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
	
		
$this->db->where('id', $sales_return_order_line_options_id);
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
$this->load->view('sales_return_order_line_options_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['salesreturnorderline__lastupdate'];
$data['updatedby'] = $_POST['salesreturnorderline__updatedby'];
$data['created'] = $_POST['salesreturnorderline__created'];
$data['createdby'] = $_POST['salesreturnorderline__createdby'];
$this->db->where('id', $data['sales_return_order_line_options_id']);
$this->db->update('salesreturnorderline', $data);
			validationonserver();
			
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