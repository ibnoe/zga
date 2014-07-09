<?php

class sales_return_order_lineview extends Controller {

	function sales_return_order_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_order_line_id=0)
	{
		if ($sales_return_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $sales_return_order_line_id);
$this->db->select('*');
$q = $this->db->get('salesreturnorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_order_line_id'] = $sales_return_order_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesreturnorderline__item_id'] = $r->item_id;
$data['salesreturnorderline__quantitytoreceive'] = $r->quantitytoreceive;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesreturnorderline__uom_id'] = $r->uom_id;
$data['salesreturnorderline__lastupdate'] = $r->lastupdate;
$data['salesreturnorderline__updatedby'] = $r->updatedby;
$data['salesreturnorderline__created'] = $r->created;
$data['salesreturnorderline__createdby'] = $r->createdby;}
$this->load->view('sales_return_order_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['salesreturnorderline__item_id'];
$data['quantitytoreceive'] = $_POST['salesreturnorderline__quantitytoreceive'];
$data['uom_id'] = $_POST['salesreturnorderline__uom_id'];
$data['lastupdate'] = $_POST['salesreturnorderline__lastupdate'];
$data['updatedby'] = $_POST['salesreturnorderline__updatedby'];
$data['created'] = $_POST['salesreturnorderline__created'];
$data['createdby'] = $_POST['salesreturnorderline__createdby'];
$this->db->where('id', $data['sales_return_order_line_id']);
$this->db->update('salesreturnorderline', $data);
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