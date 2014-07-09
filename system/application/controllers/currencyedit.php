<?php

class currencyedit extends Controller {

	function currencyedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($currency_id=0)
	{
		if ($currency_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $currency_id);
$this->db->select('*');
$q = $this->db->get('currency');
if ($q->num_rows() > 0) {
$data = array();
$data['currency_id'] = $currency_id;
foreach ($q->result() as $r) {
$data['currency__idstring'] = $r->idstring;
$data['currency__name'] = $r->name;
$data['currency__rate'] = $r->rate;
$data['currency__lastupdate'] = $r->lastupdate;
$data['currency__updatedby'] = $r->updatedby;
$data['currency__created'] = $r->created;
$data['currency__createdby'] = $r->createdby;}
$this->load->view('currency_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['currency__idstring']) && ($_POST['currency__idstring'] == "" || $_POST['currency__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['currency__idstring'])) {$this->db->where("id !=", $_POST['currency_id']);
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
$this->db->where('id', $_POST['currency_id']);
$this->db->update('currency', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('currencyedit','currency','afteredit', $_POST['currency_id']);
			
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
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