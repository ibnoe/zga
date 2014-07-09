<?php

class currencyadd extends Controller {

	function currencyadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['currency__idstring'] = '';$this->load->library('generallib');
$data['currency__idstring'] = $this->generallib->genId('Currency');
$data['currency__name'] = '';
$data['currency__rate'] = '';
$data['currency__lastupdate'] = '';
$data['currency__updatedby'] = '';
$data['currency__created'] = '';
$data['currency__createdby'] = '';
		

		$this->load->view('currency_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['currency__idstring']) && ($_POST['currency__idstring'] == "" || $_POST['currency__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['currency__idstring'])) {
$this->db->where('idstring', $_POST['currency__idstring']);
$q = $this->db->get('currency');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['currency__name']) && ($_POST['currency__name'] == "" || $_POST['currency__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['currency__idstring']))
$data['idstring'] = $_POST['currency__idstring'];if (isset($_POST['currency__name']))
$data['name'] = $_POST['currency__name'];if (isset($_POST['currency__rate']))
$data['rate'] = $_POST['currency__rate'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('currency', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$currency_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('currencyadd','currency','aftersave', $currency_id);
			
		
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