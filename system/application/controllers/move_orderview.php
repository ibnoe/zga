<?php

class move_orderview extends Controller {

	function move_orderview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($move_order_id=0)
	{
		if ($move_order_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $move_order_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('moveorder');
if ($q->num_rows() > 0) {
$data = array();
$data['move_order_id'] = $move_order_id;
foreach ($q->result() as $r) {
$data['moveorder__orderid'] = $r->orderid;
$data['moveorder__date'] = $r->date;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveorder__from_warehouse_id'] = $r->from_warehouse_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveorder__to_warehouse_id'] = $r->to_warehouse_id;
$data['moveorder__notes'] = $r->notes;
$data['moveorder__lastupdate'] = $r->lastupdate;
$data['moveorder__updatedby'] = $r->updatedby;
$data['moveorder__created'] = $r->created;
$data['moveorder__createdby'] = $r->createdby;}
$this->load->view('move_order_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['orderid'] = $_POST['moveorder__orderid'];
$data['date'] = $_POST['moveorder__date'];
$data['from_warehouse_id'] = $_POST['moveorder__from_warehouse_id'];
$data['to_warehouse_id'] = $_POST['moveorder__to_warehouse_id'];
$data['notes'] = $_POST['moveorder__notes'];
$data['lastupdate'] = $_POST['moveorder__lastupdate'];
$data['updatedby'] = $_POST['moveorder__updatedby'];
$data['created'] = $_POST['moveorder__created'];
$data['createdby'] = $_POST['moveorder__createdby'];
$this->db->where('id', $data['move_order_id']);
$this->db->update('moveorder', $data);
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