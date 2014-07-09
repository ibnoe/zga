<?php

class incoming_suppliers_itemsedit extends Controller {

	function incoming_suppliers_itemsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($incoming_suppliers_items_id=0)
	{
		if ($incoming_suppliers_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $incoming_suppliers_items_id);
$this->db->select('*');
$q = $this->db->get('purchaseorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['incoming_suppliers_items_id'] = $incoming_suppliers_items_id;
foreach ($q->result() as $r) {
$data['purchaseorderline__lastupdate'] = $r->lastupdate;
$data['purchaseorderline__updatedby'] = $r->updatedby;
$data['purchaseorderline__created'] = $r->created;
$data['purchaseorderline__createdby'] = $r->createdby;}
$this->load->view('incoming_suppliers_items_edit_form', $data);
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
$this->db->where('id', $_POST['incoming_suppliers_items_id']);
$this->db->update('purchaseorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('incoming_suppliers_itemsedit','purchaseorderline','afteredit', $_POST['incoming_suppliers_items_id']);
			
			
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