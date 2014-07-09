<?php

class alokasi_tunjangan_kesehatanview extends Controller {

	function alokasi_tunjangan_kesehatanview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($alokasi_tunjangan_kesehatan_id=0)
	{
		if ($alokasi_tunjangan_kesehatan_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $alokasi_tunjangan_kesehatan_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('tunjangankesehatanallowance');
if ($q->num_rows() > 0) {
$data = array();
$data['alokasi_tunjangan_kesehatan_id'] = $alokasi_tunjangan_kesehatan_id;
foreach ($q->result() as $r) {
$data['tunjangankesehatanallowance__date'] = $r->date;
$data['tunjangankesehatanallowance__description'] = $r->description;
$data['tunjangankesehatanallowance__amount'] = $r->amount;
$data['tunjangankesehatanallowance__notes'] = $r->notes;
$data['tunjangankesehatanallowance__lastupdate'] = $r->lastupdate;
$data['tunjangankesehatanallowance__updatedby'] = $r->updatedby;
$data['tunjangankesehatanallowance__created'] = $r->created;
$data['tunjangankesehatanallowance__createdby'] = $r->createdby;}
$this->load->view('alokasi_tunjangan_kesehatan_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['date'] = $_POST['tunjangankesehatanallowance__date'];
$data['description'] = $_POST['tunjangankesehatanallowance__description'];
$data['amount'] = $_POST['tunjangankesehatanallowance__amount'];
$data['notes'] = $_POST['tunjangankesehatanallowance__notes'];
$data['lastupdate'] = $_POST['tunjangankesehatanallowance__lastupdate'];
$data['updatedby'] = $_POST['tunjangankesehatanallowance__updatedby'];
$data['created'] = $_POST['tunjangankesehatanallowance__created'];
$data['createdby'] = $_POST['tunjangankesehatanallowance__createdby'];
$this->db->where('id', $data['alokasi_tunjangan_kesehatan_id']);
$this->db->update('tunjangankesehatanallowance', $data);
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