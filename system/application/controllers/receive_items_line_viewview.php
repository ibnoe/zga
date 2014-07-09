<?php

class receive_items_line_viewview extends Controller {

	function receive_items_line_viewview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($receive_items_line_view_id=0)
	{
		if ($receive_items_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $receive_items_line_view_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(expireddate, "%d-%m-%Y") as expireddate', false);
$q = $this->db->get('receiveditemline');
if ($q->num_rows() > 0) {
$data = array();
$data['receive_items_line_view_id'] = $receive_items_line_view_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['receiveditemline__item_id'] = $r->item_id;
$data['receiveditemline__quantitytoreceive'] = $r->quantitytoreceive;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['receiveditemline__uom_id'] = $r->uom_id;
$data['receiveditemline__serialno'] = $r->serialno;
$data['receiveditemline__expireddate'] = $r->expireddate;
$data['receiveditemline__hscode'] = $r->hscode;
$data['receiveditemline__packinglist'] = $r->packinglist;
$data['receiveditemline__lastupdate'] = $r->lastupdate;
$data['receiveditemline__updatedby'] = $r->updatedby;
$data['receiveditemline__created'] = $r->created;
$data['receiveditemline__createdby'] = $r->createdby;}
$this->load->view('receive_items_line_view_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['receiveditemline__item_id'];
$data['quantitytoreceive'] = $_POST['receiveditemline__quantitytoreceive'];
$data['uom_id'] = $_POST['receiveditemline__uom_id'];
$data['serialno'] = $_POST['receiveditemline__serialno'];
$data['expireddate'] = $_POST['receiveditemline__expireddate'];
$data['hscode'] = $_POST['receiveditemline__hscode'];
$data['packinglist'] = $_POST['receiveditemline__packinglist'];
$data['lastupdate'] = $_POST['receiveditemline__lastupdate'];
$data['updatedby'] = $_POST['receiveditemline__updatedby'];
$data['created'] = $_POST['receiveditemline__created'];
$data['createdby'] = $_POST['receiveditemline__createdby'];
$this->db->where('id', $data['receive_items_line_view_id']);
$this->db->update('receiveditemline', $data);
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