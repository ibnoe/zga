<?php

class journal_manual_lineadd extends Controller {

	function journal_manual_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['journalmanual_id'] = $id;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['journal__coa_id'] = '';
$data['journal__debit'] = '';
$data['journal__credit'] = '';
$data['journal__lastupdate'] = '';
$data['journal__updatedby'] = '';
$data['journal__created'] = '';
$data['journal__createdby'] = '';
$journalmanual = array();
$this->db->where('id', $id);
$q = $this->db->get('journalmanual');
if ($q->num_rows() > 0)
$journalmanual = $q->row_array();
$data['journal__lastupdate'] = $journalmanual['lastupdate'];
$data['journal__updatedby'] = $journalmanual['updatedby'];
$data['journal__created'] = $journalmanual['created'];
$data['journal__createdby'] = $journalmanual['createdby'];
		

		$this->load->view('journal_manual_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();
$data['journalmanual_id'] = $_POST['journalmanual_id'];if (isset($_POST['journal__coa_id']))
$data['coa_id'] = $_POST['journal__coa_id'];if (isset($_POST['journal__debit']))
$data['debit'] = $_POST['journal__debit'];if (isset($_POST['journal__credit']))
$data['credit'] = $_POST['journal__credit'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('journal', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$journal_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('journal_manual_lineadd','journal','aftersave', $journal_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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