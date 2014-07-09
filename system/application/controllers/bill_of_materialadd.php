<?php

class bill_of_materialadd extends Controller {

	function bill_of_materialadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['bom__name'] = '';
$data['bom__lastupdate'] = '';
$data['bom__updatedby'] = '';
$data['bom__created'] = '';
$data['bom__createdby'] = '';
		

		$this->load->view('bill_of_material_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['bom__name']) && ($_POST['bom__name'] == "" || $_POST['bom__name'] == null))
$error .= "<span class='error'>Bill Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['bom__name']))
$data['name'] = $_POST['bom__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('bom', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$bom_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('bill_of_materialadd','bom','aftersave', $bom_id);
			
		
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