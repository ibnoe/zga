<?php

class open_credit_note_outedit extends Controller {

	function open_credit_note_outedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_credit_note_out_id=0)
	{
		if ($open_credit_note_out_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $open_credit_note_out_id);
$this->db->select('*');
$q = $this->db->get('creditnoteout');
if ($q->num_rows() > 0) {
$data = array();
$data['open_credit_note_out_id'] = $open_credit_note_out_id;
foreach ($q->result() as $r) {
$data['creditnoteout__lastupdate'] = $r->lastupdate;
$data['creditnoteout__updatedby'] = $r->updatedby;
$data['creditnoteout__created'] = $r->created;
$data['creditnoteout__createdby'] = $r->createdby;}
$this->load->view('open_credit_note_out_edit_form', $data);
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
$this->db->where('id', $_POST['open_credit_note_out_id']);
$this->db->update('creditnoteout', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_credit_note_outedit','creditnoteout','afteredit', $_POST['open_credit_note_out_id']);
			
			
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