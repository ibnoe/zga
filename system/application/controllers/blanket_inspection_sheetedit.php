<?php

class blanket_inspection_sheetedit extends Controller {

	function blanket_inspection_sheetedit()
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
	
		
$q = $this->db->where('id', $blanket_inspection_sheet_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('blanketinspectionsheet');
if ($q->num_rows() > 0) {
$data = array();
$data['blanket_inspection_sheet_id'] = $blanket_inspection_sheet_id;
foreach ($q->result() as $r) {
$data['blanketinspectionsheet__date'] = $r->date;
$customer_opt = array();
$customer_opt[''] = 'None';
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
$this->load->view('blanket_inspection_sheet_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['blanketinspectionsheet__date']) && ($_POST['blanketinspectionsheet__date'] == "" || $_POST['blanketinspectionsheet__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['blanketinspectionsheet__customer_id']) || ($_POST['blanketinspectionsheet__customer_id'] == "" || $_POST['blanketinspectionsheet__customer_id'] == null  || $_POST['blanketinspectionsheet__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['blanketinspectionsheet__date']))
$this->db->set('date', "str_to_date('".$_POST['blanketinspectionsheet__date']."', '%d-%m-%Y')", false);if (isset($_POST['blanketinspectionsheet__customer_id']))
$data['customer_id'] = $_POST['blanketinspectionsheet__customer_id'];if (isset($_POST['blanketinspectionsheet__productname']))
$data['productname'] = $_POST['blanketinspectionsheet__productname'];if (isset($_POST['blanketinspectionsheet__presstype']))
$data['presstype'] = $_POST['blanketinspectionsheet__presstype'];if (isset($_POST['blanketinspectionsheet__barsize']))
$data['barsize'] = $_POST['blanketinspectionsheet__barsize'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['blanket_inspection_sheet_id']);
$this->db->update('blanketinspectionsheet', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('blanket_inspection_sheetedit','blanketinspectionsheet','afteredit', $_POST['blanket_inspection_sheet_id']);
			
			
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