<?php

class journal_manual_lineedit extends Controller {

	function journal_manual_lineedit()
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
	
		
$q = $this->db->where('id', $journal_manual_line_id);
$this->db->select('*');
$q = $this->db->get('journal');
if ($q->num_rows() > 0) {
$data = array();
$data['journal_manual_line_id'] = $journal_manual_line_id;
foreach ($q->result() as $r) {
$coa_opt = array();
$coa_opt[''] = 'None';
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
$this->load->view('journal_manual_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['journal__coa_id']))
$data['coa_id'] = $_POST['journal__coa_id'];if (isset($_POST['journal__debit']))
$data['debit'] = $_POST['journal__debit'];if (isset($_POST['journal__credit']))
$data['credit'] = $_POST['journal__credit'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['journal_manual_line_id']);
$this->db->update('journal', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('journal_manual_lineedit','journal','afteredit', $_POST['journal_manual_line_id']);
			
			
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