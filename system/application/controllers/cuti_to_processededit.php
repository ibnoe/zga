<?php

class cuti_to_processededit extends Controller {

	function cuti_to_processededit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($cuti_to_processed_id=0)
	{
		if ($cuti_to_processed_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $cuti_to_processed_id);
$this->db->select('*');
$q = $this->db->get('cutiklaim');
if ($q->num_rows() > 0) {
$data = array();
$data['cuti_to_processed_id'] = $cuti_to_processed_id;
foreach ($q->result() as $r) {
$data['cutiklaim__lastupdate'] = $r->lastupdate;
$data['cutiklaim__updatedby'] = $r->updatedby;
$data['cutiklaim__created'] = $r->created;
$data['cutiklaim__createdby'] = $r->createdby;}
$this->load->view('cuti_to_processed_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['cuti_to_processed_id']);
$this->db->update('cutiklaim', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('cuti_to_processededit','cutiklaim','afteredit', $_POST['cuti_to_processed_id']);
			
			
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