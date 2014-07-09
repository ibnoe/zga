<?php

class chemical_inspection_sheetview extends Controller {

	function chemical_inspection_sheetview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($chemical_inspection_sheet_id=0)
	{
		if ($chemical_inspection_sheet_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $chemical_inspection_sheet_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('chemicalinspectionsheet');
if ($q->num_rows() > 0) {
$data = array();
$data['chemical_inspection_sheet_id'] = $chemical_inspection_sheet_id;
foreach ($q->result() as $r) {
$data['chemicalinspectionsheet__date'] = $r->date;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['chemicalinspectionsheet__customer_id'] = $r->customer_id;
$data['chemicalinspectionsheet__productname'] = $r->productname;
$data['chemicalinspectionsheet__batchno'] = $r->batchno;
$data['chemicalinspectionsheet__chemicaltype'] = $r->chemicaltype;
$data['chemicalinspectionsheet__lastupdate'] = $r->lastupdate;
$data['chemicalinspectionsheet__updatedby'] = $r->updatedby;
$data['chemicalinspectionsheet__created'] = $r->created;
$data['chemicalinspectionsheet__createdby'] = $r->createdby;}
$this->load->view('chemical_inspection_sheet_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['chemicalinspectionsheet__date'];
$data['customer_id'] = $_POST['chemicalinspectionsheet__customer_id'];
$data['productname'] = $_POST['chemicalinspectionsheet__productname'];
$data['batchno'] = $_POST['chemicalinspectionsheet__batchno'];
$data['chemicaltype'] = $_POST['chemicalinspectionsheet__chemicaltype'];
$data['lastupdate'] = $_POST['chemicalinspectionsheet__lastupdate'];
$data['updatedby'] = $_POST['chemicalinspectionsheet__updatedby'];
$data['created'] = $_POST['chemicalinspectionsheet__created'];
$data['createdby'] = $_POST['chemicalinspectionsheet__createdby'];
$this->db->where('id', $data['chemical_inspection_sheet_id']);
$this->db->update('chemicalinspectionsheet', $data);
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