<?php

class customermesinview extends Controller {

	function customermesinview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($customermesin_id=0)
	{
		if ($customermesin_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $customermesin_id);
$this->db->select('*');
$q = $this->db->get('customermesin');
if ($q->num_rows() > 0) {
$data = array();
$data['customermesin_id'] = $customermesin_id;
foreach ($q->result() as $r) {
$mesin_opt = array();
$q = $this->db->get('mesin');
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['customermesin__mesin_id'] = $r->mesin_id;
$data['customermesin__nomesin'] = $r->nomesin;
$data['customermesin__noserimesin'] = $r->noserimesin;
$data['customermesin__tahun'] = $r->tahun;
$data['customermesin__konfigurasi'] = $r->konfigurasi;
$data['customermesin__jumlahblanket'] = $r->jumlahblanket;
$data['customermesin__jumlahroll'] = $r->jumlahroll;
$data['customermesin__notes'] = $r->notes;
$data['customermesin__lastupdate'] = $r->lastupdate;
$data['customermesin__updatedby'] = $r->updatedby;
$data['customermesin__created'] = $r->created;
$data['customermesin__createdby'] = $r->createdby;}
$this->load->view('customermesin_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['mesin_id'] = $_POST['customermesin__mesin_id'];
$data['nomesin'] = $_POST['customermesin__nomesin'];
$data['noserimesin'] = $_POST['customermesin__noserimesin'];
$data['tahun'] = $_POST['customermesin__tahun'];
$data['konfigurasi'] = $_POST['customermesin__konfigurasi'];
$data['jumlahblanket'] = $_POST['customermesin__jumlahblanket'];
$data['jumlahroll'] = $_POST['customermesin__jumlahroll'];
$data['notes'] = $_POST['customermesin__notes'];
$data['lastupdate'] = $_POST['customermesin__lastupdate'];
$data['updatedby'] = $_POST['customermesin__updatedby'];
$data['created'] = $_POST['customermesin__created'];
$data['createdby'] = $_POST['customermesin__createdby'];
$this->db->where('id', $data['customermesin_id']);
$this->db->update('customermesin', $data);
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