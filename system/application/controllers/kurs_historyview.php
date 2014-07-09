<?php

class kurs_historyview extends Controller {

	function kurs_historyview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($kurs_history_id=0)
	{
		if ($kurs_history_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $kurs_history_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('kurshistory');
if ($q->num_rows() > 0) {
$data = array();
$data['kurs_history_id'] = $kurs_history_id;
foreach ($q->result() as $r) {
$data['kurshistory__idstring'] = $r->idstring;
$data['kurshistory__date'] = $r->date;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['kurshistory__currency_id'] = $r->currency_id;
$data['kurshistory__value'] = $r->value;
$data['kurshistory__notes'] = $r->notes;
$data['kurshistory__lastupdate'] = $r->lastupdate;
$data['kurshistory__updatedby'] = $r->updatedby;
$data['kurshistory__created'] = $r->created;
$data['kurshistory__createdby'] = $r->createdby;}
$this->load->view('kurs_history_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['kurshistory__idstring'];
$data['date'] = $_POST['kurshistory__date'];
$data['currency_id'] = $_POST['kurshistory__currency_id'];
$data['value'] = $_POST['kurshistory__value'];
$data['notes'] = $_POST['kurshistory__notes'];
$data['lastupdate'] = $_POST['kurshistory__lastupdate'];
$data['updatedby'] = $_POST['kurshistory__updatedby'];
$data['created'] = $_POST['kurshistory__created'];
$data['createdby'] = $_POST['kurshistory__createdby'];
$this->db->where('id', $data['kurs_history_id']);
$this->db->update('kurshistory', $data);
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