<?php

class stock_adjustmentview extends Controller {

	function stock_adjustmentview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($stock_adjustment_id=0)
	{
		if ($stock_adjustment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $stock_adjustment_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('stockadjustment');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_adjustment_id'] = $stock_adjustment_id;
foreach ($q->result() as $r) {
$data['stockadjustment__idstring'] = $r->idstring;
$data['stockadjustment__date'] = $r->date;
$data['stockadjustment__notes'] = $r->notes;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['stockadjustment__warehouse_id'] = $r->warehouse_id;
$data['stockadjustment__lastupdate'] = $r->lastupdate;
$data['stockadjustment__updatedby'] = $r->updatedby;
$data['stockadjustment__created'] = $r->created;
$data['stockadjustment__createdby'] = $r->createdby;}
$this->load->view('stock_adjustment_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['stockadjustment__idstring'];
$data['date'] = $_POST['stockadjustment__date'];
$data['notes'] = $_POST['stockadjustment__notes'];
$data['warehouse_id'] = $_POST['stockadjustment__warehouse_id'];
$data['lastupdate'] = $_POST['stockadjustment__lastupdate'];
$data['updatedby'] = $_POST['stockadjustment__updatedby'];
$data['created'] = $_POST['stockadjustment__created'];
$data['createdby'] = $_POST['stockadjustment__createdby'];
$this->db->where('id', $data['stock_adjustment_id']);
$this->db->update('stockadjustment', $data);
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