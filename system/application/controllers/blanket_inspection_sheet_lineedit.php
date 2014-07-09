<?php

class blanket_inspection_sheet_lineedit extends Controller {

	function blanket_inspection_sheet_lineedit()
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
	
		
$q = $this->db->where('id', $blanket_inspection_sheet_line_id);
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
$this->load->view('blanket_inspection_sheet_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['blanketinspectionsheetline__barringdate']) && ($_POST['blanketinspectionsheetline__barringdate'] == "" || $_POST['blanketinspectionsheetline__barringdate'] == null))
$error .= "<span class='error'>Barring Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['blanketinspectionsheetline__qccode']))
$data['qccode'] = $_POST['blanketinspectionsheetline__qccode'];if (isset($_POST['blanketinspectionsheetline__ac1']))
$data['ac1'] = $_POST['blanketinspectionsheetline__ac1'];if (isset($_POST['blanketinspectionsheetline__ac2']))
$data['ac2'] = $_POST['blanketinspectionsheetline__ac2'];if (isset($_POST['blanketinspectionsheetline__ar1']))
$data['ar1'] = $_POST['blanketinspectionsheetline__ar1'];if (isset($_POST['blanketinspectionsheetline__ar2']))
$data['ar2'] = $_POST['blanketinspectionsheetline__ar2'];if (isset($_POST['blanketinspectionsheetline__thickness']))
$data['thickness'] = $_POST['blanketinspectionsheetline__thickness'];if (isset($_POST['blanketinspectionsheetline__ks']))
$data['ks'] = $_POST['blanketinspectionsheetline__ks'];if (isset($_POST['blanketinspectionsheetline__rollno']))
$data['rollno'] = $_POST['blanketinspectionsheetline__rollno'];if (isset($_POST['blanketinspectionsheetline__barringdate']))
$this->db->set('barringdate', "str_to_date('".$_POST['blanketinspectionsheetline__barringdate']."', '%d-%m-%Y')", false);
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['blanket_inspection_sheet_line_id']);
$this->db->update('blanketinspectionsheetline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('blanket_inspection_sheet_lineedit','blanketinspectionsheetline','afteredit', $_POST['blanket_inspection_sheet_line_id']);
			
			
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