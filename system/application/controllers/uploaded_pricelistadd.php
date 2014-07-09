<?php

class uploaded_pricelistadd extends Controller {

	function uploaded_pricelistadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['uploadedpricelist__name'] = '';
$data['uploadedpricelist__notes'] = '';
$data['uploadedpricelist__lastupdate'] = '';
$data['uploadedpricelist__updatedby'] = '';
$data['uploadedpricelist__created'] = '';
$data['uploadedpricelist__createdby'] = '';
		

		$this->load->view('uploaded_pricelist_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['uploadedpricelist__name']) && ($_POST['uploadedpricelist__name'] == "" || $_POST['uploadedpricelist__name'] == null))
$error .= "<span class='error'>File must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
if (isset($_FILES['uploadedpricelist__name'])){$filepath = 'upload//'.$_FILES['uploadedpricelist__name']['name'];move_uploaded_file($_FILES['uploadedpricelist__name']['tmp_name'], $filepath);$data['name'] = $_FILES['uploadedpricelist__name']['name'];}if (isset($_POST['uploadedpricelist__notes']))
$data['notes'] = $_POST['uploadedpricelist__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('uploadedpricelist', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$uploadedpricelist_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('uploaded_pricelistadd','uploadedpricelist','aftersave', $uploadedpricelist_id);
			
		
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