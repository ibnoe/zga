<?php

class purchase_return_order_lineview extends Controller {

	function purchase_return_order_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_order_line_id=0)
	{
		if ($purchase_return_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $purchase_return_order_line_id);
$this->db->select('*');
$q = $this->db->get('purchasereturnorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_order_line_id'] = $purchase_return_order_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchasereturnorderline__item_id'] = $r->item_id;
$data['purchasereturnorderline__quantitytosend'] = $r->quantitytosend;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchasereturnorderline__uom_id'] = $r->uom_id;
$data['purchasereturnorderline__lastupdate'] = $r->lastupdate;
$data['purchasereturnorderline__updatedby'] = $r->updatedby;
$data['purchasereturnorderline__created'] = $r->created;
$data['purchasereturnorderline__createdby'] = $r->createdby;}
$this->load->view('purchase_return_order_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['purchasereturnorderline__item_id'];
$data['quantitytosend'] = $_POST['purchasereturnorderline__quantitytosend'];
$data['uom_id'] = $_POST['purchasereturnorderline__uom_id'];
$data['lastupdate'] = $_POST['purchasereturnorderline__lastupdate'];
$data['updatedby'] = $_POST['purchasereturnorderline__updatedby'];
$data['created'] = $_POST['purchasereturnorderline__created'];
$data['createdby'] = $_POST['purchasereturnorderline__createdby'];
$this->db->where('id', $data['purchase_return_order_line_id']);
$this->db->update('purchasereturnorderline', $data);
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