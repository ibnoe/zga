<?php

class outgoing_customers_itemsedit extends Controller {

	function outgoing_customers_itemsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($outgoing_customers_items_id=0)
	{
		if ($outgoing_customers_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $outgoing_customers_items_id);
$this->db->select('*');
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['outgoing_customers_items_id'] = $outgoing_customers_items_id;
foreach ($q->result() as $r) {
$data['salesorderline__lastupdate'] = $r->lastupdate;
$data['salesorderline__updatedby'] = $r->updatedby;
$data['salesorderline__created'] = $r->created;
$data['salesorderline__createdby'] = $r->createdby;}
$this->load->view('outgoing_customers_items_edit_form', $data);
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
$this->db->where('id', $_POST['outgoing_customers_items_id']);
$this->db->update('salesorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('outgoing_customers_itemsedit','salesorderline','afteredit', $_POST['outgoing_customers_items_id']);
			
			
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