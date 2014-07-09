<?php

class klaim_tunjangan_kesehatanview extends Controller {

	function klaim_tunjangan_kesehatanview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($klaim_tunjangan_kesehatan_id=0)
	{
		if ($klaim_tunjangan_kesehatan_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $klaim_tunjangan_kesehatan_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('tunjangankesehatanusage');
if ($q->num_rows() > 0) {
$data = array();
$data['klaim_tunjangan_kesehatan_id'] = $klaim_tunjangan_kesehatan_id;
foreach ($q->result() as $r) {
$data['tunjangankesehatanusage__date'] = $r->date;
$data['tunjangankesehatanusage__description'] = $r->description;
$data['tunjangankesehatanusage__amount'] = $r->amount;
$data['tunjangankesehatanusage__amountpaid'] = $r->amountpaid;
$data['tunjangankesehatanusage__notes'] = $r->notes;
$data['tunjangankesehatanusage__lastupdate'] = $r->lastupdate;
$data['tunjangankesehatanusage__updatedby'] = $r->updatedby;
$data['tunjangankesehatanusage__created'] = $r->created;
$data['tunjangankesehatanusage__createdby'] = $r->createdby;}
$this->load->view('klaim_tunjangan_kesehatan_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['tunjangankesehatanusage__date'];
$data['description'] = $_POST['tunjangankesehatanusage__description'];
$data['amount'] = $_POST['tunjangankesehatanusage__amount'];
$data['amountpaid'] = $_POST['tunjangankesehatanusage__amountpaid'];
$data['notes'] = $_POST['tunjangankesehatanusage__notes'];
$data['lastupdate'] = $_POST['tunjangankesehatanusage__lastupdate'];
$data['updatedby'] = $_POST['tunjangankesehatanusage__updatedby'];
$data['created'] = $_POST['tunjangankesehatanusage__created'];
$data['createdby'] = $_POST['tunjangankesehatanusage__createdby'];
$this->db->where('id', $data['klaim_tunjangan_kesehatan_id']);
$this->db->update('tunjangankesehatanusage', $data);
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