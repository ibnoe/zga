<?php

class rifview extends Controller {

	function rifview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($rif_id=0)
	{
		if ($rif_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $rif_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(incomingrolldate, "%d-%m-%Y") as incomingrolldate', false);
$this->db->select('DATE_FORMAT(identificationdate, "%d-%m-%Y") as identificationdate', false);
$q = $this->db->get('rcn');
if ($q->num_rows() > 0) {
$data = array();
$data['rif_id'] = $rif_id;
foreach ($q->result() as $r) {
$data['rcn__norif'] = $r->norif;
$data['rcn__incomingrolldate'] = $r->incomingrolldate;
$data['rcn__incomingrolltime'] = $r->incomingrolltime;
$data['rcn__identificationdate'] = $r->identificationdate;
$data['rcn__identificationtime'] = $r->identificationtime;
$data['rcn__press'] = $r->press;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['rcn__customer_id'] = $r->customer_id;
$data['rcn__nodiss'] = $r->nodiss;
$data['rcn__datercn'] = $r->datercn;
$data['rcn__totalrollerscollected'] = $r->totalrollerscollected;
$data['rcn__lastupdate'] = $r->lastupdate;
$data['rcn__updatedby'] = $r->updatedby;
$data['rcn__created'] = $r->created;
$data['rcn__createdby'] = $r->createdby;}
$this->load->view('rif_view_form', $data);
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
$data['incomingrolldate'] = $_POST['rcn__incomingrolldate'];
$data['incomingrolltime'] = $_POST['rcn__incomingrolltime'];
$data['identificationdate'] = $_POST['rcn__identificationdate'];
$data['identificationtime'] = $_POST['rcn__identificationtime'];
$data['press'] = $_POST['rcn__press'];
$data['customer_id'] = $_POST['rcn__customer_id'];
$data['nodiss'] = $_POST['rcn__nodiss'];
$data['datercn'] = $_POST['rcn__datercn'];
$data['totalrollerscollected'] = $_POST['rcn__totalrollerscollected'];
$data['lastupdate'] = $_POST['rcn__lastupdate'];
$data['updatedby'] = $_POST['rcn__updatedby'];
$data['created'] = $_POST['rcn__created'];
$data['createdby'] = $_POST['rcn__createdby'];
$this->db->where('id', $data['rif_id']);
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