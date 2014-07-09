<?php

class permintaan_stock_lineview extends Controller {

	function permintaan_stock_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($permintaan_stock_line_id=0)
	{
		if ($permintaan_stock_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $permintaan_stock_line_id);
$this->db->select('*');
$q = $this->db->get('permintaanstockline');
if ($q->num_rows() > 0) {
$data = array();
$data['permintaan_stock_line_id'] = $permintaan_stock_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['permintaanstockline__item_id'] = $r->item_id;
$data['permintaanstockline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['permintaanstockline__uom_id'] = $r->uom_id;
$data['permintaanstockline__lastupdate'] = $r->lastupdate;
$data['permintaanstockline__updatedby'] = $r->updatedby;
$data['permintaanstockline__created'] = $r->created;
$data['permintaanstockline__createdby'] = $r->createdby;}
$this->load->view('permintaan_stock_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['permintaanstockline__item_id'];
$data['quantity'] = $_POST['permintaanstockline__quantity'];
$data['uom_id'] = $_POST['permintaanstockline__uom_id'];
$data['lastupdate'] = $_POST['permintaanstockline__lastupdate'];
$data['updatedby'] = $_POST['permintaanstockline__updatedby'];
$data['created'] = $_POST['permintaanstockline__created'];
$data['createdby'] = $_POST['permintaanstockline__createdby'];
$this->db->where('id', $data['permintaan_stock_line_id']);
$this->db->update('permintaanstockline', $data);
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