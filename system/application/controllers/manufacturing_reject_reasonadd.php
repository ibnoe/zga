<?php

class manufacturing_reject_reasonadd extends Controller {

	function manufacturing_reject_reasonadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['manufacturingrejectreason__name'] = '';
$data['manufacturingrejectreason__name'] = '';$this->load->library('generallib');
$data['manufacturingrejectreason__name'] = $this->generallib->genId('Manufacturing Reject Reason');
$data['manufacturingrejectreason__lastupdate'] = '';
$data['manufacturingrejectreason__updatedby'] = '';
$data['manufacturingrejectreason__created'] = '';
$data['manufacturingrejectreason__createdby'] = '';
		

		$this->load->view('manufacturing_reject_reason_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['manufacturingrejectreason__name']) && ($_POST['manufacturingrejectreason__name'] == "" || $_POST['manufacturingrejectreason__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (isset($_POST['manufacturingrejectreason__name']) && ($_POST['manufacturingrejectreason__name'] == "" || $_POST['manufacturingrejectreason__name'] == null))
$error .= "<span class='error'>Notes must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['manufacturingrejectreason__name']))
$data['name'] = $_POST['manufacturingrejectreason__name'];if (isset($_POST['manufacturingrejectreason__name']))
$data['name'] = $_POST['manufacturingrejectreason__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('manufacturingrejectreason', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$manufacturingrejectreason_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_reject_reasonadd','manufacturingrejectreason','aftersave', $manufacturingrejectreason_id);
			
		
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