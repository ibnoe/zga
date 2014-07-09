<?php

class merk_mesinadd extends Controller {

	function merk_mesinadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['merkmesin__idstring'] = '';
$data['merkmesin__name'] = '';
$data['merkmesin__lastupdate'] = '';
$data['merkmesin__updatedby'] = '';
$data['merkmesin__created'] = '';
$data['merkmesin__createdby'] = '';
		

		$this->load->view('merk_mesin_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['merkmesin__idstring']) && ($_POST['merkmesin__idstring'] == "" || $_POST['merkmesin__idstring'] == null))
$error .= "<span class='error'>Kode Merk Mesin must not be empty"."</span><br>";

if (isset($_POST['merkmesin__idstring'])) {
$this->db->where('idstring', $_POST['merkmesin__idstring']);
$q = $this->db->get('merkmesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>Kode Merk Mesin must be unique"."</span><br>";}

if (isset($_POST['merkmesin__name']) && ($_POST['merkmesin__name'] == "" || $_POST['merkmesin__name'] == null))
$error .= "<span class='error'>Merk Mesin must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['merkmesin__idstring']))
$data['idstring'] = $_POST['merkmesin__idstring'];if (isset($_POST['merkmesin__name']))
$data['name'] = $_POST['merkmesin__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('merkmesin', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$merkmesin_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('merk_mesinadd','merkmesin','aftersave', $merkmesin_id);
			
		
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