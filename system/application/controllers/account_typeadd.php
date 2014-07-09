<?php

class account_typeadd extends Controller {

	function account_typeadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['coatype__classtype'] = '';
$data['coatype__name'] = '';
$data['coatype__lastupdate'] = '';
$data['coatype__updatedby'] = '';
$data['coatype__created'] = '';
$data['coatype__createdby'] = '';
		

		$this->load->view('account_type_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['coatype__name']) && ($_POST['coatype__name'] == "" || $_POST['coatype__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['coatype__classtype']))
$data['classtype'] = $_POST['coatype__classtype'];if (isset($_POST['coatype__name']))
$data['name'] = $_POST['coatype__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('coatype', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$coatype_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('account_typeadd','coatype','aftersave', $coatype_id);
			
		
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