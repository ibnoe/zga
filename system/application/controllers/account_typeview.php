<?php

class account_typeview extends Controller {

	function account_typeview()
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
	
		
$this->db->where('id', $account_type_id);
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
$this->load->view('account_type_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['classtype'] = $_POST['coatype__classtype'];
$data['name'] = $_POST['coatype__name'];
$data['lastupdate'] = $_POST['coatype__lastupdate'];
$data['updatedby'] = $_POST['coatype__updatedby'];
$data['created'] = $_POST['coatype__created'];
$data['createdby'] = $_POST['coatype__createdby'];
$this->db->where('id', $data['account_type_id']);
$this->db->update('coatype', $data);
			validationonserver();
			
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