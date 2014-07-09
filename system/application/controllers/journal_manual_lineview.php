<?php

class journal_manual_lineview extends Controller {

	function journal_manual_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($journal_manual_line_id=0)
	{
		if ($journal_manual_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $journal_manual_line_id);
$this->db->select('*');
$q = $this->db->get('journal');
if ($q->num_rows() > 0) {
$data = array();
$data['journal_manual_line_id'] = $journal_manual_line_id;
foreach ($q->result() as $r) {
$coa_opt = array();
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['journal__coa_id'] = $r->coa_id;
$data['journal__debit'] = $r->debit;
$data['journal__credit'] = $r->credit;
$data['journal__lastupdate'] = $r->lastupdate;
$data['journal__updatedby'] = $r->updatedby;
$data['journal__created'] = $r->created;
$data['journal__createdby'] = $r->createdby;}
$this->load->view('journal_manual_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['coa_id'] = $_POST['journal__coa_id'];
$data['debit'] = $_POST['journal__debit'];
$data['credit'] = $_POST['journal__credit'];
$data['lastupdate'] = $_POST['journal__lastupdate'];
$data['updatedby'] = $_POST['journal__updatedby'];
$data['created'] = $_POST['journal__created'];
$data['createdby'] = $_POST['journal__createdby'];
$this->db->where('id', $data['journal_manual_line_id']);
$this->db->update('journal', $data);
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