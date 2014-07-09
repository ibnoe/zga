<?php

class blanket_inspection_sheet_lineview extends Controller {

	function blanket_inspection_sheet_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($blanket_inspection_sheet_line_id=0)
	{
		if ($blanket_inspection_sheet_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $blanket_inspection_sheet_line_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(barringdate, "%d-%m-%Y") as barringdate', false);
$q = $this->db->get('blanketinspectionsheetline');
if ($q->num_rows() > 0) {
$data = array();
$data['blanket_inspection_sheet_line_id'] = $blanket_inspection_sheet_line_id;
foreach ($q->result() as $r) {
$data['blanketinspectionsheetline__qccode'] = $r->qccode;
$data['blanketinspectionsheetline__ac1'] = $r->ac1;
$data['blanketinspectionsheetline__ac2'] = $r->ac2;
$data['blanketinspectionsheetline__ar1'] = $r->ar1;
$data['blanketinspectionsheetline__ar2'] = $r->ar2;
$data['blanketinspectionsheetline__thickness'] = $r->thickness;
$data['blanketinspectionsheetline__ks'] = $r->ks;
$data['blanketinspectionsheetline__rollno'] = $r->rollno;
$data['blanketinspectionsheetline__barringdate'] = $r->barringdate;
$data['blanketinspectionsheetline__lastupdate'] = $r->lastupdate;
$data['blanketinspectionsheetline__updatedby'] = $r->updatedby;
$data['blanketinspectionsheetline__created'] = $r->created;
$data['blanketinspectionsheetline__createdby'] = $r->createdby;}
$this->load->view('blanket_inspection_sheet_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['qccode'] = $_POST['blanketinspectionsheetline__qccode'];
$data['ac1'] = $_POST['blanketinspectionsheetline__ac1'];
$data['ac2'] = $_POST['blanketinspectionsheetline__ac2'];
$data['ar1'] = $_POST['blanketinspectionsheetline__ar1'];
$data['ar2'] = $_POST['blanketinspectionsheetline__ar2'];
$data['thickness'] = $_POST['blanketinspectionsheetline__thickness'];
$data['ks'] = $_POST['blanketinspectionsheetline__ks'];
$data['rollno'] = $_POST['blanketinspectionsheetline__rollno'];
$data['barringdate'] = $_POST['blanketinspectionsheetline__barringdate'];
$data['lastupdate'] = $_POST['blanketinspectionsheetline__lastupdate'];
$data['updatedby'] = $_POST['blanketinspectionsheetline__updatedby'];
$data['created'] = $_POST['blanketinspectionsheetline__created'];
$data['createdby'] = $_POST['blanketinspectionsheetline__createdby'];
$this->db->where('id', $data['blanket_inspection_sheet_line_id']);
$this->db->update('blanketinspectionsheetline', $data);
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