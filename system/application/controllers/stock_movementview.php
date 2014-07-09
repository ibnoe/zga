<?php

class stock_movementview extends Controller {

	function stock_movementview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($stock_movement_id=0)
	{
		if ($stock_movement_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $stock_movement_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('moveaction');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_movement_id'] = $stock_movement_id;
foreach ($q->result() as $r) {
$data['moveaction__date'] = $r->date;
$data['moveaction__orderid'] = $r->orderid;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveaction__from_warehouse_id'] = $r->from_warehouse_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveaction__to_warehouse_id'] = $r->to_warehouse_id;
$data['moveaction__lastupdate'] = $r->lastupdate;
$data['moveaction__updatedby'] = $r->updatedby;
$data['moveaction__created'] = $r->created;
$data['moveaction__createdby'] = $r->createdby;}
$this->load->view('stock_movement_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['moveaction__date'];
$data['orderid'] = $_POST['moveaction__orderid'];
$data['from_warehouse_id'] = $_POST['moveaction__from_warehouse_id'];
$data['to_warehouse_id'] = $_POST['moveaction__to_warehouse_id'];
$data['lastupdate'] = $_POST['moveaction__lastupdate'];
$data['updatedby'] = $_POST['moveaction__updatedby'];
$data['created'] = $_POST['moveaction__created'];
$data['createdby'] = $_POST['moveaction__createdby'];
$this->db->where('id', $data['stock_movement_id']);
$this->db->update('moveaction', $data);
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