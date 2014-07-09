<?php

class cuti_approvaledit extends Controller {

	function cuti_approvaledit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($cuti_approval_id=0)
	{
		if ($cuti_approval_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $cuti_approval_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('cutiklaim');
if ($q->num_rows() > 0) {
$data = array();
$data['cuti_approval_id'] = $cuti_approval_id;
foreach ($q->result() as $r) {
$data['cutiklaim__date'] = $r->date;
$data['cutiklaim__totalcutiklaimed'] = $r->totalcutiklaimed;
$data['cutiklaim__notes'] = $r->notes;
$data['cutiklaim__status'] = $r->status;
$data['cutiklaim__lastupdate'] = $r->lastupdate;
$data['cutiklaim__updatedby'] = $r->updatedby;
$data['cutiklaim__created'] = $r->created;
$data['cutiklaim__createdby'] = $r->createdby;}
$this->load->view('cuti_approval_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['cutiklaim__date']) && ($_POST['cutiklaim__date'] == "" || $_POST['cutiklaim__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['cutiklaim__date']))
$this->db->set('date', "str_to_date('".$_POST['cutiklaim__date']."', '%d-%m-%Y')", false);if (isset($_POST['cutiklaim__totalcutiklaimed']))
$data['totalcutiklaimed'] = $_POST['cutiklaim__totalcutiklaimed'];if (isset($_POST['cutiklaim__notes']))
$data['notes'] = $_POST['cutiklaim__notes'];if (isset($_POST['cutiklaim__status']))
$data['status'] = $_POST['cutiklaim__status'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['cuti_approval_id']);
$this->db->update('cutiklaim', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('cuti_approvaledit','cutiklaim','afteredit', $_POST['cuti_approval_id']);
			
			
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