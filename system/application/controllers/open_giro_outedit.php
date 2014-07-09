<?php

class open_giro_outedit extends Controller {

	function open_giro_outedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_giro_out_id=0)
	{
		if ($open_giro_out_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $open_giro_out_id);
$this->db->select('*');
$q = $this->db->get('giroout');
if ($q->num_rows() > 0) {
$data = array();
$data['open_giro_out_id'] = $open_giro_out_id;
foreach ($q->result() as $r) {
$data['giroout__lastupdate'] = $r->lastupdate;
$data['giroout__updatedby'] = $r->updatedby;
$data['giroout__created'] = $r->created;
$data['giroout__createdby'] = $r->createdby;}
$this->load->view('open_giro_out_edit_form', $data);
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
$this->db->where('id', $_POST['open_giro_out_id']);
$this->db->update('giroout', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_giro_outedit','giroout','afteredit', $_POST['open_giro_out_id']);
			
			
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