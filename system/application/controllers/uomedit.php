<?php

class uomedit extends Controller {

	function uomedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($uom_id=0)
	{
		if ($uom_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $uom_id);
$this->db->select('*');
$q = $this->db->get('uom');
if ($q->num_rows() > 0) {
$data = array();
$data['uom_id'] = $uom_id;
foreach ($q->result() as $r) {
$data['uom__name'] = $r->name;
$data['uom__multiplier'] = $r->multiplier;
$data['uom__lastupdate'] = $r->lastupdate;
$data['uom__updatedby'] = $r->updatedby;
$data['uom__created'] = $r->created;
$data['uom__createdby'] = $r->createdby;}
$this->load->view('uom_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['uom__name']) && ($_POST['uom__name'] == "" || $_POST['uom__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['uom__name']))
$data['name'] = $_POST['uom__name'];if (isset($_POST['uom__multiplier']))
$data['multiplier'] = $_POST['uom__multiplier'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['uom_id']);
$this->db->update('uom', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('uomedit','uom','afteredit', $_POST['uom_id']);
			
			
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