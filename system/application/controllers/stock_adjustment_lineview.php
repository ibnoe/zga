<?php

class stock_adjustment_lineview extends Controller {

	function stock_adjustment_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($stock_adjustment_line_id=0)
	{
		if ($stock_adjustment_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $stock_adjustment_line_id);
$this->db->select('*');
$q = $this->db->get('stockadjustmentline');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_adjustment_line_id'] = $stock_adjustment_line_id;
foreach ($q->result() as $r) {
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['stockadjustmentline__coa_id'] = $r->coa_id;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['stockadjustmentline__item_id'] = $r->item_id;
$data['stockadjustmentline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['stockadjustmentline__uom_id'] = $r->uom_id;
$data['stockadjustmentline__lastupdate'] = $r->lastupdate;
$data['stockadjustmentline__updatedby'] = $r->updatedby;
$data['stockadjustmentline__created'] = $r->created;
$data['stockadjustmentline__createdby'] = $r->createdby;}
$this->load->view('stock_adjustment_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['coa_id'] = $_POST['stockadjustmentline__coa_id'];
$data['item_id'] = $_POST['stockadjustmentline__item_id'];
$data['quantity'] = $_POST['stockadjustmentline__quantity'];
$data['uom_id'] = $_POST['stockadjustmentline__uom_id'];
$data['lastupdate'] = $_POST['stockadjustmentline__lastupdate'];
$data['updatedby'] = $_POST['stockadjustmentline__updatedby'];
$data['created'] = $_POST['stockadjustmentline__created'];
$data['createdby'] = $_POST['stockadjustmentline__createdby'];
$this->db->where('id', $data['stock_adjustment_line_id']);
$this->db->update('stockadjustmentline', $data);
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