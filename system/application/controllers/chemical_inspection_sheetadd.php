<?php

class chemical_inspection_sheetadd extends Controller {

	function chemical_inspection_sheetadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['chemicalinspectionsheet__date'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['chemicalinspectionsheet__customer_id'] = '';
$data['chemicalinspectionsheet__productname'] = '';
$data['chemicalinspectionsheet__batchno'] = '';
$data['chemicalinspectionsheet__chemicaltype'] = '';
$data['chemicalinspectionsheet__lastupdate'] = '';
$data['chemicalinspectionsheet__updatedby'] = '';
$data['chemicalinspectionsheet__created'] = '';
$data['chemicalinspectionsheet__createdby'] = '';
		

		$this->load->view('chemical_inspection_sheet_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['chemicalinspectionsheet__date']) && ($_POST['chemicalinspectionsheet__date'] == "" || $_POST['chemicalinspectionsheet__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['chemicalinspectionsheet__customer_id']) || ($_POST['chemicalinspectionsheet__customer_id'] == "" || $_POST['chemicalinspectionsheet__customer_id'] == null  || $_POST['chemicalinspectionsheet__customer_id'] == null))
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
$this->db->insert('chemicalinspectionsheet', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$chemicalinspectionsheet_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('chemical_inspection_sheetadd','chemicalinspectionsheet','aftersave', $chemicalinspectionsheet_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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