<?php

class receive_itemsview extends Controller {

	function receive_itemsview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($receive_items_id=0)
	{
		if ($receive_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $receive_items_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('receiveditem');
if ($q->num_rows() > 0) {
$data = array();
$data['receive_items_id'] = $receive_items_id;
foreach ($q->result() as $r) {
$data['receiveditem__date'] = $r->date;
$data['receiveditem__orderid'] = $r->orderid;
$data['receiveditem__suratjalanno'] = $r->suratjalanno;
$supplier_opt = array();
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['receiveditem__supplier_id'] = $r->supplier_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['receiveditem__warehouse_id'] = $r->warehouse_id;
$data['receiveditem__lastupdate'] = $r->lastupdate;
$data['receiveditem__updatedby'] = $r->updatedby;
$data['receiveditem__created'] = $r->created;
$data['receiveditem__createdby'] = $r->createdby;}
$this->load->view('receive_items_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['receiveditem__date'];
$data['orderid'] = $_POST['receiveditem__orderid'];
$data['suratjalanno'] = $_POST['receiveditem__suratjalanno'];
$data['supplier_id'] = $_POST['receiveditem__supplier_id'];
$data['warehouse_id'] = $_POST['receiveditem__warehouse_id'];
$data['lastupdate'] = $_POST['receiveditem__lastupdate'];
$data['updatedby'] = $_POST['receiveditem__updatedby'];
$data['created'] = $_POST['receiveditem__created'];
$data['createdby'] = $_POST['receiveditem__createdby'];
$this->db->where('id', $data['receive_items_id']);
$this->db->update('receiveditem', $data);
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