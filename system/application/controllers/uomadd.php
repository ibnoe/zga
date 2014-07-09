<?php

class uomadd extends Controller {

	function uomadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['uom__name'] = '';
$data['uom__multiplier'] = '1';
$data['uom__lastupdate'] = '';
$data['uom__updatedby'] = '';
$data['uom__created'] = '';
$data['uom__createdby'] = '';
		

		$this->load->view('uom_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['uom__name']) && ($_POST['uom__name'] == "" || $_POST['uom__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['uom__name']))
$data['name'] = $_POST['uom__name'];if (isset($_POST['uom__multiplier']))
$data['multiplier'] = $_POST['uom__multiplier'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('uom', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$uom_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('uomadd','uom','aftersave', $uom_id);
			
		
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