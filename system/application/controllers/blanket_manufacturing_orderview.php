<?php

class blanket_manufacturing_orderview extends Controller {

	function blanket_manufacturing_orderview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($blanket_manufacturing_order_id=0)
	{
		if ($blanket_manufacturing_order_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $blanket_manufacturing_order_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('manufacturingorder');
if ($q->num_rows() > 0) {
$data = array();
$data['blanket_manufacturing_order_id'] = $blanket_manufacturing_order_id;
foreach ($q->result() as $r) {
$data['manufacturingorder__idstring'] = $r->idstring;
$data['manufacturingorder__date'] = $r->date;
$bif_opt = array();
$q = $this->db->get('bif');
foreach ($q->result() as $row) { $bif_opt[$row->id] = $row->idstring; }
$data['bif_opt'] = $bif_opt;
$data['manufacturingorder__bif_id'] = $r->bif_id;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingorder__item_id'] = $r->item_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingorder__from_warehouse_id'] = $r->from_warehouse_id;
$warehouse_opt = array();
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingorder__to_warehouse_id'] = $r->to_warehouse_id;
$bom_opt = array();
$q = $this->db->get('bom');
foreach ($q->result() as $row) { $bom_opt[$row->id] = $row->name; }
$data['bom_opt'] = $bom_opt;
$data['manufacturingorder__bom_id'] = $r->bom_id;
$data['manufacturingorder__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingorder__uom_id'] = $r->uom_id;
$data['manufacturingorder__lastupdate'] = $r->lastupdate;
$data['manufacturingorder__updatedby'] = $r->updatedby;
$data['manufacturingorder__created'] = $r->created;
$data['manufacturingorder__createdby'] = $r->createdby;}
$this->load->view('blanket_manufacturing_order_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['manufacturingorder__idstring'];
$data['date'] = $_POST['manufacturingorder__date'];
$data['bif_id'] = $_POST['manufacturingorder__bif_id'];
$data['item_id'] = $_POST['manufacturingorder__item_id'];
$data['from_warehouse_id'] = $_POST['manufacturingorder__from_warehouse_id'];
$data['to_warehouse_id'] = $_POST['manufacturingorder__to_warehouse_id'];
$data['bom_id'] = $_POST['manufacturingorder__bom_id'];
$data['quantity'] = $_POST['manufacturingorder__quantity'];
$data['uom_id'] = $_POST['manufacturingorder__uom_id'];
$data['lastupdate'] = $_POST['manufacturingorder__lastupdate'];
$data['updatedby'] = $_POST['manufacturingorder__updatedby'];
$data['created'] = $_POST['manufacturingorder__created'];
$data['createdby'] = $_POST['manufacturingorder__createdby'];
$this->db->where('id', $data['blanket_manufacturing_order_id']);
$this->db->update('manufacturingorder', $data);
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