<?php

class blanket_inspection_sheetadd extends Controller {

	function blanket_inspection_sheetadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['blanketinspectionsheet__date'] = '';
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['blanketinspectionsheet__customer_id'] = '';
$data['blanketinspectionsheet__productname'] = '';
$data['blanketinspectionsheet__presstype'] = '';
$data['blanketinspectionsheet__barsize'] = '';
$data['blanketinspectionsheet__lastupdate'] = '';
$data['blanketinspectionsheet__updatedby'] = '';
$data['blanketinspectionsheet__created'] = '';
$data['blanketinspectionsheet__createdby'] = '';
		

		$this->load->view('blanket_inspection_sheet_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['blanketinspectionsheet__date']) && ($_POST['blanketinspectionsheet__date'] == "" || $_POST['blanketinspectionsheet__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['blanketinspectionsheet__customer_id']) || ($_POST['blanketinspectionsheet__customer_id'] == "" || $_POST['blanketinspectionsheet__customer_id'] == null  || $_POST['blanketinspectionsheet__customer_id'] == null))
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
$this->db->insert('blanketinspectionsheet', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$blanketinspectionsheet_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('blanket_inspection_sheetadd','blanketinspectionsheet','aftersave', $blanketinspectionsheet_id);
			
		
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