<?php

class cuti_approvaladd extends Controller {

	function cuti_approvaladd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['cutiklaim__date'] = '';
$data['cutiklaim__totalcutiklaimed'] = '';
$data['cutiklaim__notes'] = '';
$data['cutiklaim__status'] = '';
$data['cutiklaim__lastupdate'] = '';
$data['cutiklaim__updatedby'] = '';
$data['cutiklaim__created'] = '';
$data['cutiklaim__createdby'] = '';
		

		$this->load->view('cuti_approval_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['cutiklaim__date']) && ($_POST['cutiklaim__date'] == "" || $_POST['cutiklaim__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['cutiklaim__date']))
$this->db->set('date', "str_to_date('".$_POST['cutiklaim__date']."', '%d-%m-%Y')", false);if (isset($_POST['cutiklaim__totalcutiklaimed']))
$data['totalcutiklaimed'] = $_POST['cutiklaim__totalcutiklaimed'];if (isset($_POST['cutiklaim__notes']))
$data['notes'] = $_POST['cutiklaim__notes'];if (isset($_POST['cutiklaim__status']))
$data['status'] = $_POST['cutiklaim__status'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('cutiklaim', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$cutiklaim_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('cuti_approvaladd','cutiklaim','aftersave', $cutiklaim_id);
			
		
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