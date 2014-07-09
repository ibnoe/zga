<?php

class blanket_inspection_sheetview extends Controller {

	function blanket_inspection_sheetview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($blanket_inspection_sheet_id=0)
	{
		if ($blanket_inspection_sheet_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $blanket_inspection_sheet_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('blanketinspectionsheet');
if ($q->num_rows() > 0) {
$data = array();
$data['blanket_inspection_sheet_id'] = $blanket_inspection_sheet_id;
foreach ($q->result() as $r) {
$data['blanketinspectionsheet__date'] = $r->date;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['blanketinspectionsheet__customer_id'] = $r->customer_id;
$data['blanketinspectionsheet__productname'] = $r->productname;
$data['blanketinspectionsheet__presstype'] = $r->presstype;
$data['blanketinspectionsheet__barsize'] = $r->barsize;
$data['blanketinspectionsheet__lastupdate'] = $r->lastupdate;
$data['blanketinspectionsheet__updatedby'] = $r->updatedby;
$data['blanketinspectionsheet__created'] = $r->created;
$data['blanketinspectionsheet__createdby'] = $r->createdby;}
$this->load->view('blanket_inspection_sheet_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['blanketinspectionsheet__date'];
$data['customer_id'] = $_POST['blanketinspectionsheet__customer_id'];
$data['productname'] = $_POST['blanketinspectionsheet__productname'];
$data['presstype'] = $_POST['blanketinspectionsheet__presstype'];
$data['barsize'] = $_POST['blanketinspectionsheet__barsize'];
$data['lastupdate'] = $_POST['blanketinspectionsheet__lastupdate'];
$data['updatedby'] = $_POST['blanketinspectionsheet__updatedby'];
$data['created'] = $_POST['blanketinspectionsheet__created'];
$data['createdby'] = $_POST['blanketinspectionsheet__createdby'];
$this->db->where('id', $data['blanket_inspection_sheet_id']);
$this->db->update('blanketinspectionsheet', $data);
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