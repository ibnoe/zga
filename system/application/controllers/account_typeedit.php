<?php

class account_typeedit extends Controller {

	function account_typeedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($account_type_id=0)
	{
		if ($account_type_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $account_type_id);
$this->db->select('*');
$q = $this->db->get('coatype');
if ($q->num_rows() > 0) {
$data = array();
$data['account_type_id'] = $account_type_id;
foreach ($q->result() as $r) {
$data['coatype__classtype'] = $r->classtype;
$data['coatype__name'] = $r->name;
$data['coatype__lastupdate'] = $r->lastupdate;
$data['coatype__updatedby'] = $r->updatedby;
$data['coatype__created'] = $r->created;
$data['coatype__createdby'] = $r->createdby;}
$this->load->view('account_type_edit_form', $data);
}
		

		
		
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
$this->db->where('id', $_POST['account_type_id']);
$this->db->update('coatype', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('account_typeedit','coatype','afteredit', $_POST['account_type_id']);
			
			
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