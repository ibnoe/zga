<?php

class manufacturing_rejectview extends Controller {

	function manufacturing_rejectview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_reject_id=0)
	{
		if ($manufacturing_reject_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $manufacturing_reject_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('manufacturingreject');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_reject_id'] = $manufacturing_reject_id;
foreach ($q->result() as $r) {
$data['manufacturingreject__idstring'] = $r->idstring;
$data['manufacturingreject__date'] = $r->date;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingreject__item_id'] = $r->item_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingreject__warehouse_id'] = $r->warehouse_id;
$data['manufacturingreject__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingreject__uom_id'] = $r->uom_id;
$data['manufacturingreject__lastupdate'] = $r->lastupdate;
$data['manufacturingreject__updatedby'] = $r->updatedby;
$data['manufacturingreject__created'] = $r->created;
$data['manufacturingreject__createdby'] = $r->createdby;}
$this->load->view('manufacturing_reject_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['manufacturingreject__idstring'];
$data['date'] = $_POST['manufacturingreject__date'];
$data['item_id'] = $_POST['manufacturingreject__item_id'];
$data['warehouse_id'] = $_POST['manufacturingreject__warehouse_id'];
$data['quantity'] = $_POST['manufacturingreject__quantity'];
$data['uom_id'] = $_POST['manufacturingreject__uom_id'];
$data['lastupdate'] = $_POST['manufacturingreject__lastupdate'];
$data['updatedby'] = $_POST['manufacturingreject__updatedby'];
$data['created'] = $_POST['manufacturingreject__created'];
$data['createdby'] = $_POST['manufacturingreject__createdby'];
$this->db->where('id', $data['manufacturing_reject_id']);
$this->db->update('manufacturingreject', $data);
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