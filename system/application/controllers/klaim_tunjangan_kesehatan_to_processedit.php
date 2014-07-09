<?php

class klaim_tunjangan_kesehatan_to_processedit extends Controller {

	function klaim_tunjangan_kesehatan_to_processedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($klaim_tunjangan_kesehatan_to_process_id=0)
	{
		if ($klaim_tunjangan_kesehatan_to_process_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $klaim_tunjangan_kesehatan_to_process_id);
$this->db->select('*');
$q = $this->db->get('tunjangankesehatanusage');
if ($q->num_rows() > 0) {
$data = array();
$data['klaim_tunjangan_kesehatan_to_process_id'] = $klaim_tunjangan_kesehatan_to_process_id;
foreach ($q->result() as $r) {
$data['tunjangankesehatanusage__lastupdate'] = $r->lastupdate;
$data['tunjangankesehatanusage__updatedby'] = $r->updatedby;
$data['tunjangankesehatanusage__created'] = $r->created;
$data['tunjangankesehatanusage__createdby'] = $r->createdby;}
$this->load->view('klaim_tunjangan_kesehatan_to_process_edit_form', $data);
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
$this->db->where('id', $_POST['klaim_tunjangan_kesehatan_to_process_id']);
$this->db->update('tunjangankesehatanusage', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('klaim_tunjangan_kesehatan_to_processedit','tunjangankesehatanusage','afteredit', $_POST['klaim_tunjangan_kesehatan_to_process_id']);
			
			
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