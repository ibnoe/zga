<?php

class blanket_inspection_sheet_lineadd extends Controller {

	function blanket_inspection_sheet_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['blanketinspectionsheet_id'] = $id;
$data['blanketinspectionsheetline__qccode'] = '';
$data['blanketinspectionsheetline__ac1'] = '';
$data['blanketinspectionsheetline__ac2'] = '';
$data['blanketinspectionsheetline__ar1'] = '';
$data['blanketinspectionsheetline__ar2'] = '';
$data['blanketinspectionsheetline__thickness'] = '';
$data['blanketinspectionsheetline__ks'] = '';
$data['blanketinspectionsheetline__rollno'] = '';
$data['blanketinspectionsheetline__barringdate'] = '';
$data['blanketinspectionsheetline__lastupdate'] = '';
$data['blanketinspectionsheetline__updatedby'] = '';
$data['blanketinspectionsheetline__created'] = '';
$data['blanketinspectionsheetline__createdby'] = '';
$blanketinspectionsheet = array();
$this->db->where('id', $id);
$q = $this->db->get('blanketinspectionsheet');
if ($q->num_rows() > 0)
$blanketinspectionsheet = $q->row_array();
$data['blanketinspectionsheetline__lastupdate'] = $blanketinspectionsheet['lastupdate'];
$data['blanketinspectionsheetline__updatedby'] = $blanketinspectionsheet['updatedby'];
$data['blanketinspectionsheetline__created'] = $blanketinspectionsheet['created'];
$data['blanketinspectionsheetline__createdby'] = $blanketinspectionsheet['createdby'];
		

		$this->load->view('blanket_inspection_sheet_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['blanketinspectionsheetline__barringdate']) && ($_POST['blanketinspectionsheetline__barringdate'] == "" || $_POST['blanketinspectionsheetline__barringdate'] == null))
$error .= "<span class='error'>Barring Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['blanketinspectionsheet_id'] = $_POST['blanketinspectionsheet_id'];if (isset($_POST['blanketinspectionsheetline__qccode']))
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
$this->db->insert('blanketinspectionsheetline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$blanketinspectionsheetline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('blanket_inspection_sheet_lineadd','blanketinspectionsheetline','aftersave', $blanketinspectionsheetline_id);
			
		
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