<?php

class permintaan_stock_chemicalview extends Controller {

	function permintaan_stock_chemicalview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($permintaan_stock_chemical_id=0)
	{
		if ($permintaan_stock_chemical_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $permintaan_stock_chemical_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('permintaanstockchemical');
if ($q->num_rows() > 0) {
$data = array();
$data['permintaan_stock_chemical_id'] = $permintaan_stock_chemical_id;
foreach ($q->result() as $r) {
$data['permintaanstockchemical__idstring'] = $r->idstring;
$data['permintaanstockchemical__date'] = $r->date;
$data['permintaanstockchemical__notes'] = $r->notes;
$data['permintaanstockchemical__lastupdate'] = $r->lastupdate;
$data['permintaanstockchemical__updatedby'] = $r->updatedby;
$data['permintaanstockchemical__created'] = $r->created;
$data['permintaanstockchemical__createdby'] = $r->createdby;}
$this->load->view('permintaan_stock_chemical_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['permintaanstockchemical__idstring'];
$data['date'] = $_POST['permintaanstockchemical__date'];
$data['notes'] = $_POST['permintaanstockchemical__notes'];
$data['lastupdate'] = $_POST['permintaanstockchemical__lastupdate'];
$data['updatedby'] = $_POST['permintaanstockchemical__updatedby'];
$data['created'] = $_POST['permintaanstockchemical__created'];
$data['createdby'] = $_POST['permintaanstockchemical__createdby'];
$this->db->where('id', $data['permintaan_stock_chemical_id']);
$this->db->update('permintaanstockchemical', $data);
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