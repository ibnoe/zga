<?php

class rcnview extends Controller {

	function rcnview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($rcn_id=0)
	{
		if ($rcn_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $rcn_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(datercn, "%d-%m-%Y") as datercn', false);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) {
$data = array();
$data['rcn_id'] = $rcn_id;
foreach ($q->result() as $r) {
$data['rcn__norif'] = $r->norif;
$data['rcn__norcn'] = $r->norcn;
$data['rcn__customerponumber'] = $r->customerponumber;
$data['rcn__datercn'] = $r->datercn;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['rcn__customer_id'] = $r->customer_id;
$data['rcn__reqtorecover'] = $r->reqtorecover;
$data['rcn__reqcoretoreturn'] = $r->reqcoretoreturn;
$data['rcn__reqreturnunused'] = $r->reqreturnunused;
$data['rcn__reqreturnfaulty'] = $r->reqreturnfaulty;
$data['rcn__reqothers'] = $r->reqothers;
$data['rcn__notes'] = $r->notes;
$data['rcn__status'] = $r->status;
$data['rcn__totalrollerscollected'] = $r->totalrollerscollected;
$data['rcn__lastupdate'] = $r->lastupdate;
$data['rcn__updatedby'] = $r->updatedby;
$data['rcn__created'] = $r->created;
$data['rcn__createdby'] = $r->createdby;}
$this->load->view('rcn_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['norif'] = $_POST['rcn__norif'];
$data['norcn'] = $_POST['rcn__norcn'];
$data['customerponumber'] = $_POST['rcn__customerponumber'];
$data['datercn'] = $_POST['rcn__datercn'];
$data['customer_id'] = $_POST['rcn__customer_id'];
$data['reqtorecover'] = $_POST['rcn__reqtorecover'];
$data['reqcoretoreturn'] = $_POST['rcn__reqcoretoreturn'];
$data['reqreturnunused'] = $_POST['rcn__reqreturnunused'];
$data['reqreturnfaulty'] = $_POST['rcn__reqreturnfaulty'];
$data['reqothers'] = $_POST['rcn__reqothers'];
$data['notes'] = $_POST['rcn__notes'];
$data['status'] = $_POST['rcn__status'];
$data['totalrollerscollected'] = $_POST['rcn__totalrollerscollected'];
$data['lastupdate'] = $_POST['rcn__lastupdate'];
$data['updatedby'] = $_POST['rcn__updatedby'];
$data['created'] = $_POST['rcn__created'];
$data['createdby'] = $_POST['rcn__createdby'];
$this->db->where('id', $data['rcn_id']);
$this->db->update('rcn', $data);
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