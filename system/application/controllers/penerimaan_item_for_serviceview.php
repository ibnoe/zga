<?php

class penerimaan_item_for_serviceview extends Controller {

	function penerimaan_item_for_serviceview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($penerimaan_item_for_service_id=0)
	{
		if ($penerimaan_item_for_service_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $penerimaan_item_for_service_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('insertitem');
if ($q->num_rows() > 0) {
$data = array();
$data['penerimaan_item_for_service_id'] = $penerimaan_item_for_service_id;
foreach ($q->result() as $r) {
$data['insertitem__idstring'] = $r->idstring;
$data['insertitem__date'] = $r->date;
$data['insertitem__notes'] = $r->notes;
$data['insertitem__lastupdate'] = $r->lastupdate;
$data['insertitem__updatedby'] = $r->updatedby;
$data['insertitem__created'] = $r->created;
$data['insertitem__createdby'] = $r->createdby;}
$this->load->view('penerimaan_item_for_service_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['insertitem__idstring'];
$data['date'] = $_POST['insertitem__date'];
$data['notes'] = $_POST['insertitem__notes'];
$data['lastupdate'] = $_POST['insertitem__lastupdate'];
$data['updatedby'] = $_POST['insertitem__updatedby'];
$data['created'] = $_POST['insertitem__created'];
$data['createdby'] = $_POST['insertitem__createdby'];
$this->db->where('id', $data['penerimaan_item_for_service_id']);
$this->db->update('insertitem', $data);
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