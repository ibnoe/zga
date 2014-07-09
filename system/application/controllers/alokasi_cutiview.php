<?php

class alokasi_cutiview extends Controller {

	function alokasi_cutiview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($alokasi_cuti_id=0)
	{
		if ($alokasi_cuti_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $alokasi_cuti_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(begindate, "%d-%m-%Y") as begindate', false);
$q = $this->db->get('cutiallowance');
if ($q->num_rows() > 0) {
$data = array();
$data['alokasi_cuti_id'] = $alokasi_cuti_id;
foreach ($q->result() as $r) {
$data['cutiallowance__begindate'] = $r->begindate;
$data['cutiallowance__totalcuti'] = $r->totalcuti;
$data['cutiallowance__notes'] = $r->notes;
$data['cutiallowance__lastupdate'] = $r->lastupdate;
$data['cutiallowance__updatedby'] = $r->updatedby;
$data['cutiallowance__created'] = $r->created;
$data['cutiallowance__createdby'] = $r->createdby;}
$this->load->view('alokasi_cuti_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['begindate'] = $_POST['cutiallowance__begindate'];
$data['totalcuti'] = $_POST['cutiallowance__totalcuti'];
$data['notes'] = $_POST['cutiallowance__notes'];
$data['lastupdate'] = $_POST['cutiallowance__lastupdate'];
$data['updatedby'] = $_POST['cutiallowance__updatedby'];
$data['created'] = $_POST['cutiallowance__created'];
$data['createdby'] = $_POST['cutiallowance__createdby'];
$this->db->where('id', $data['alokasi_cuti_id']);
$this->db->update('cutiallowance', $data);
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