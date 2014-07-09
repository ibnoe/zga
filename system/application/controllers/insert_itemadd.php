<?php

class insert_itemadd extends Controller {

	function insert_itemadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['insertitem__idstring'] = '';$this->load->library('generallib');
$data['insertitem__idstring'] = $this->generallib->genId('Insert Item');
$data['insertitem__date'] = '';
$data['insertitem__notes'] = '';
$data['insertitem__lastupdate'] = '';
$data['insertitem__updatedby'] = '';
$data['insertitem__created'] = '';
$data['insertitem__createdby'] = '';
		

		$this->load->view('insert_item_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['insertitem__idstring']) && ($_POST['insertitem__idstring'] == "" || $_POST['insertitem__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['insertitem__idstring'])) {
$this->db->where('idstring', $_POST['insertitem__idstring']);
$q = $this->db->get('insertitem');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['insertitem__date']) && ($_POST['insertitem__date'] == "" || $_POST['insertitem__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['insertitem__idstring']))
$data['idstring'] = $_POST['insertitem__idstring'];if (isset($_POST['insertitem__date']))
$this->db->set('date', "str_to_date('".$_POST['insertitem__date']."', '%d-%m-%Y')", false);if (isset($_POST['insertitem__notes']))
$data['notes'] = $_POST['insertitem__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('insertitem', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$insertitem_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('insert_itemadd','insertitem','aftersave', $insertitem_id);
			
		
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