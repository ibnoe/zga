<?php

class chemical_inspection_sheetedit extends Controller {

	function chemical_inspection_sheetedit()
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
	
		
$q = $this->db->where('id', $chemical_inspection_sheet_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('chemicalinspectionsheet');
if ($q->num_rows() > 0) {
$data = array();
$data['chemical_inspection_sheet_id'] = $chemical_inspection_sheet_id;
foreach ($q->result() as $r) {
$data['chemicalinspectionsheet__date'] = $r->date;
$customer_opt = array();
$customer_opt[''] = 'None';
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
$this->load->view('chemical_inspection_sheet_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['chemicalinspectionsheet__date']) && ($_POST['chemicalinspectionsheet__date'] == "" || $_POST['chemicalinspectionsheet__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['chemicalinspectionsheet__customer_id']) || ($_POST['chemicalinspectionsheet__customer_id'] == "" || $_POST['chemicalinspectionsheet__customer_id'] == null  || $_POST['chemicalinspectionsheet__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['chemicalinspectionsheet__date']))
$this->db->set('date', "str_to_date('".$_POST['chemicalinspectionsheet__date']."', '%d-%m-%Y')", false);if (isset($_POST['chemicalinspectionsheet__customer_id']))
$data['customer_id'] = $_POST['chemicalinspectionsheet__customer_id'];if (isset($_POST['chemicalinspectionsheet__productname']))
$data['productname'] = $_POST['chemicalinspectionsheet__productname'];if (isset($_POST['chemicalinspectionsheet__batchno']))
$data['batchno'] = $_POST['chemicalinspectionsheet__batchno'];if (isset($_POST['chemicalinspectionsheet__chemicaltype']))
$data['chemicaltype'] = $_POST['chemicalinspectionsheet__chemicaltype'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['chemical_inspection_sheet_id']);
$this->db->update('chemicalinspectionsheet', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('chemical_inspection_sheetedit','chemicalinspectionsheet','afteredit', $_POST['chemical_inspection_sheet_id']);
			
			
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