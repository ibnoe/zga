<?php

class sent_customers_itemsedit extends Controller {

	function sent_customers_itemsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sent_customers_items_id=0)
	{
		if ($sent_customers_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sent_customers_items_id);
$this->db->select('*');
$q = $this->db->get('deliveryorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sent_customers_items_id'] = $sent_customers_items_id;
foreach ($q->result() as $r) {
$data['deliveryorderline__lastupdate'] = $r->lastupdate;
$data['deliveryorderline__updatedby'] = $r->updatedby;
$data['deliveryorderline__created'] = $r->created;
$data['deliveryorderline__createdby'] = $r->createdby;}
$this->load->view('sent_customers_items_edit_form', $data);
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
$this->db->where('id', $_POST['sent_customers_items_id']);
$this->db->update('deliveryorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sent_customers_itemsedit','deliveryorderline','afteredit', $_POST['sent_customers_items_id']);
			
			
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