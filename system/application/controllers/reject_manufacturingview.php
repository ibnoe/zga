<?php

class reject_manufacturingview extends Controller {

	function reject_manufacturingview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($reject_manufacturing_id=0)
	{
		if ($reject_manufacturing_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $reject_manufacturing_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('rejectmanufacturing');
if ($q->num_rows() > 0) {
$data = array();
$data['reject_manufacturing_id'] = $reject_manufacturing_id;
foreach ($q->result() as $r) {
$data['rejectmanufacturing__idstring'] = $r->idstring;
$data['rejectmanufacturing__date'] = $r->date;
$manufacturingrejectreason_opt = array();
$q = $this->db->get('manufacturingrejectreason');
foreach ($q->result() as $row) { $manufacturingrejectreason_opt[$row->id] = $row->name; }
$data['manufacturingrejectreason_opt'] = $manufacturingrejectreason_opt;
$data['rejectmanufacturing__manufacturingrejectreason_id'] = $r->manufacturingrejectreason_id;
$data['rejectmanufacturing__notes'] = $r->notes;
$data['rejectmanufacturing__lastupdate'] = $r->lastupdate;
$data['rejectmanufacturing__updatedby'] = $r->updatedby;
$data['rejectmanufacturing__created'] = $r->created;
$data['rejectmanufacturing__createdby'] = $r->createdby;}
$this->load->view('reject_manufacturing_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['rejectmanufacturing__idstring'];
$data['date'] = $_POST['rejectmanufacturing__date'];
$data['manufacturingrejectreason_id'] = $_POST['rejectmanufacturing__manufacturingrejectreason_id'];
$data['notes'] = $_POST['rejectmanufacturing__notes'];
$data['lastupdate'] = $_POST['rejectmanufacturing__lastupdate'];
$data['updatedby'] = $_POST['rejectmanufacturing__updatedby'];
$data['created'] = $_POST['rejectmanufacturing__created'];
$data['createdby'] = $_POST['rejectmanufacturing__createdby'];
$this->db->where('id', $data['reject_manufacturing_id']);
$this->db->update('rejectmanufacturing', $data);
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