<?php

class blanket_identification_formview extends Controller {

	function blanket_identification_formview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($blanket_identification_form_id=0)
	{
		if ($blanket_identification_form_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $blanket_identification_form_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('bif');
if ($q->num_rows() > 0) {
$data = array();
$data['blanket_identification_form_id'] = $blanket_identification_form_id;
foreach ($q->result() as $r) {
$data['bif__idstring'] = $r->idstring;
$data['bif__date'] = $r->date;
$marketingofficer_opt = array();
$q = $this->db->get('marketingofficer');
foreach ($q->result() as $row) { $marketingofficer_opt[$row->id] = $row->name; }
$data['marketingofficer_opt'] = $marketingofficer_opt;
$data['bif__marketingofficer_id'] = $r->marketingofficer_id;
$customer_opt = array();
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['bif__customer_id'] = $r->customer_id;
$data['bif__pressmodel'] = $r->pressmodel;
$data['bif__ac'] = $r->ac;
$data['bif__ar'] = $r->ar;
$data['bif__thickness'] = $r->thickness;
$data['bif__typebar1'] = $r->typebar1;
$data['bif__lengthbar1'] = $r->lengthbar1;
$data['bif__positionbar1'] = $r->positionbar1;
$data['bif__typebar2'] = $r->typebar2;
$data['bif__lengthbar2'] = $r->lengthbar2;
$data['bif__positionbar2'] = $r->positionbar2;
$data['bif__corner'] = $r->corner;
$data['bif__needs'] = $r->needs;
$data['bif__drawingfile'] = $r->drawingfile;
$data['bif__notes'] = $r->notes;
$data['bif__lastupdate'] = $r->lastupdate;
$data['bif__updatedby'] = $r->updatedby;
$data['bif__created'] = $r->created;
$data['bif__createdby'] = $r->createdby;}
$this->load->view('blanket_identification_form_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['bif__idstring'];
$data['date'] = $_POST['bif__date'];
$data['marketingofficer_id'] = $_POST['bif__marketingofficer_id'];
$data['customer_id'] = $_POST['bif__customer_id'];
$data['pressmodel'] = $_POST['bif__pressmodel'];
$data['ac'] = $_POST['bif__ac'];
$data['ar'] = $_POST['bif__ar'];
$data['thickness'] = $_POST['bif__thickness'];
$data['typebar1'] = $_POST['bif__typebar1'];
$data['lengthbar1'] = $_POST['bif__lengthbar1'];
$data['positionbar1'] = $_POST['bif__positionbar1'];
$data['typebar2'] = $_POST['bif__typebar2'];
$data['lengthbar2'] = $_POST['bif__lengthbar2'];
$data['positionbar2'] = $_POST['bif__positionbar2'];
$data['corner'] = $_POST['bif__corner'];
$data['needs'] = $_POST['bif__needs'];
if (isset($_FILES['drawingfile'])){$filepath = 'penawarandocs/'.$_FILES['drawingfile']['name'];move_uploaded_file($_FILES['drawingfile']['tmp_name'], $filepath);}
$data['drawingfile'] = $_POST['bif__drawingfile'];
$data['notes'] = $_POST['bif__notes'];
$data['lastupdate'] = $_POST['bif__lastupdate'];
$data['updatedby'] = $_POST['bif__updatedby'];
$data['created'] = $_POST['bif__created'];
$data['createdby'] = $_POST['bif__createdby'];
$this->db->where('id', $data['blanket_identification_form_id']);
$this->db->update('bif', $data);
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