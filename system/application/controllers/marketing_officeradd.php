<?php

class marketing_officeradd extends Controller {

	function marketing_officeradd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['marketingofficer__idstring'] = '';$this->load->library('generallib');
$data['marketingofficer__idstring'] = $this->generallib->genId('Marketing Officer');
$data['marketingofficer__name'] = '';
$data['marketingofficer__notes'] = '';
$data['marketingofficer__lastupdate'] = '';
$data['marketingofficer__updatedby'] = '';
$data['marketingofficer__created'] = '';
$data['marketingofficer__createdby'] = '';
		

		$this->load->view('marketing_officer_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['marketingofficer__idstring']) && ($_POST['marketingofficer__idstring'] == "" || $_POST['marketingofficer__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['marketingofficer__idstring'])) {
$this->db->where('idstring', $_POST['marketingofficer__idstring']);
$q = $this->db->get('marketingofficer');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['marketingofficer__name']) && ($_POST['marketingofficer__name'] == "" || $_POST['marketingofficer__name'] == null))
$error .= "<span class='error'>Officer Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['marketingofficer__idstring']))
$data['idstring'] = $_POST['marketingofficer__idstring'];if (isset($_POST['marketingofficer__name']))
$data['name'] = $_POST['marketingofficer__name'];if (isset($_POST['marketingofficer__notes']))
$data['notes'] = $_POST['marketingofficer__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('marketingofficer', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$marketingofficer_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('marketing_officeradd','marketingofficer','aftersave', $marketingofficer_id);
			
		
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