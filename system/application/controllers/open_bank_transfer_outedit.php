<?php

class open_bank_transfer_outedit extends Controller {

	function open_bank_transfer_outedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_bank_transfer_out_id=0)
	{
		if ($open_bank_transfer_out_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $open_bank_transfer_out_id);
$this->db->select('*');
$q = $this->db->get('banktransferkeluar');
if ($q->num_rows() > 0) {
$data = array();
$data['open_bank_transfer_out_id'] = $open_bank_transfer_out_id;
foreach ($q->result() as $r) {
$data['banktransferkeluar__lastupdate'] = $r->lastupdate;
$data['banktransferkeluar__updatedby'] = $r->updatedby;
$data['banktransferkeluar__created'] = $r->created;
$data['banktransferkeluar__createdby'] = $r->createdby;}
$this->load->view('open_bank_transfer_out_edit_form', $data);
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
$this->db->where('id', $_POST['open_bank_transfer_out_id']);
$this->db->update('banktransferkeluar', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_bank_transfer_outedit','banktransferkeluar','afteredit', $_POST['open_bank_transfer_out_id']);
			
			
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