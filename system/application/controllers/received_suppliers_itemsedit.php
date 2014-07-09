<?php

class received_suppliers_itemsedit extends Controller {

	function received_suppliers_itemsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($received_suppliers_items_id=0)
	{
		if ($received_suppliers_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $received_suppliers_items_id);
$this->db->select('*');
$q = $this->db->get('receiveditemline');
if ($q->num_rows() > 0) {
$data = array();
$data['received_suppliers_items_id'] = $received_suppliers_items_id;
foreach ($q->result() as $r) {
$data['receiveditemline__lastupdate'] = $r->lastupdate;
$data['receiveditemline__updatedby'] = $r->updatedby;
$data['receiveditemline__created'] = $r->created;
$data['receiveditemline__createdby'] = $r->createdby;}
$this->load->view('received_suppliers_items_edit_form', $data);
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
$this->db->where('id', $_POST['received_suppliers_items_id']);
$this->db->update('receiveditemline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('received_suppliers_itemsedit','receiveditemline','afteredit', $_POST['received_suppliers_items_id']);
			
			
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