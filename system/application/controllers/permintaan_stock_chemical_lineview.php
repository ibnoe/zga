<?php

class permintaan_stock_chemical_lineview extends Controller {

	function permintaan_stock_chemical_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($permintaan_stock_chemical_line_id=0)
	{
		if ($permintaan_stock_chemical_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $permintaan_stock_chemical_line_id);
$this->db->select('*');
$q = $this->db->get('permintaanstockchemicalline');
if ($q->num_rows() > 0) {
$data = array();
$data['permintaan_stock_chemical_line_id'] = $permintaan_stock_chemical_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['permintaanstockchemicalline__item_id'] = $r->item_id;
$data['permintaanstockchemicalline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['permintaanstockchemicalline__uom_id'] = $r->uom_id;
$data['permintaanstockchemicalline__lastupdate'] = $r->lastupdate;
$data['permintaanstockchemicalline__updatedby'] = $r->updatedby;
$data['permintaanstockchemicalline__created'] = $r->created;
$data['permintaanstockchemicalline__createdby'] = $r->createdby;}
$this->load->view('permintaan_stock_chemical_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['permintaanstockchemicalline__item_id'];
$data['quantity'] = $_POST['permintaanstockchemicalline__quantity'];
$data['uom_id'] = $_POST['permintaanstockchemicalline__uom_id'];
$data['lastupdate'] = $_POST['permintaanstockchemicalline__lastupdate'];
$data['updatedby'] = $_POST['permintaanstockchemicalline__updatedby'];
$data['created'] = $_POST['permintaanstockchemicalline__created'];
$data['createdby'] = $_POST['permintaanstockchemicalline__createdby'];
$this->db->where('id', $data['permintaan_stock_chemical_line_id']);
$this->db->update('permintaanstockchemicalline', $data);
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