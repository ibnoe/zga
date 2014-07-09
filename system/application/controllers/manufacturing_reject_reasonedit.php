<?php

class manufacturing_reject_reasonedit extends Controller {

	function manufacturing_reject_reasonedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_reject_reason_id=0)
	{
		if ($manufacturing_reject_reason_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $manufacturing_reject_reason_id);
$this->db->select('*');
$q = $this->db->get('manufacturingrejectreason');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_reject_reason_id'] = $manufacturing_reject_reason_id;
foreach ($q->result() as $r) {
$data['manufacturingrejectreason__name'] = $r->name;
$data['manufacturingrejectreason__name'] = $r->name;
$data['manufacturingrejectreason__lastupdate'] = $r->lastupdate;
$data['manufacturingrejectreason__updatedby'] = $r->updatedby;
$data['manufacturingrejectreason__created'] = $r->created;
$data['manufacturingrejectreason__createdby'] = $r->createdby;}
$this->load->view('manufacturing_reject_reason_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['manufacturingrejectreason__name']) && ($_POST['manufacturingrejectreason__name'] == "" || $_POST['manufacturingrejectreason__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (isset($_POST['manufacturingrejectreason__name']) && ($_POST['manufacturingrejectreason__name'] == "" || $_POST['manufacturingrejectreason__name'] == null))
$error .= "<span class='error'>Notes must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['manufacturingrejectreason__name']))
$data['name'] = $_POST['manufacturingrejectreason__name'];if (isset($_POST['manufacturingrejectreason__name']))
$data['name'] = $_POST['manufacturingrejectreason__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['manufacturing_reject_reason_id']);
$this->db->update('manufacturingrejectreason', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_reject_reasonedit','manufacturingrejectreason','afteredit', $_POST['manufacturing_reject_reason_id']);
			
			
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