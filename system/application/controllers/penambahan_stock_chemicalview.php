<?php

class penambahan_stock_chemicalview extends Controller {

	function penambahan_stock_chemicalview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($penambahan_stock_chemical_id=0)
	{
		if ($penambahan_stock_chemical_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $penambahan_stock_chemical_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('penambahanstockchemical');
if ($q->num_rows() > 0) {
$data = array();
$data['penambahan_stock_chemical_id'] = $penambahan_stock_chemical_id;
foreach ($q->result() as $r) {
$data['penambahanstockchemical__idstring'] = $r->idstring;
$data['penambahanstockchemical__date'] = $r->date;
$data['penambahanstockchemical__name'] = $r->name;
$data['penambahanstockchemical__joborderno'] = $r->joborderno;
$data['penambahanstockchemical__batchno'] = $r->batchno;
$data['penambahanstockchemical__packing'] = $r->packing;
$data['penambahanstockchemical__qtyliterkg'] = $r->qtyliterkg;
$data['penambahanstockchemical__notes'] = $r->notes;
$data['penambahanstockchemical__lastupdate'] = $r->lastupdate;
$data['penambahanstockchemical__updatedby'] = $r->updatedby;
$data['penambahanstockchemical__created'] = $r->created;
$data['penambahanstockchemical__createdby'] = $r->createdby;}
$this->load->view('penambahan_stock_chemical_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['penambahanstockchemical__idstring'];
$data['date'] = $_POST['penambahanstockchemical__date'];
$data['name'] = $_POST['penambahanstockchemical__name'];
$data['joborderno'] = $_POST['penambahanstockchemical__joborderno'];
$data['batchno'] = $_POST['penambahanstockchemical__batchno'];
$data['packing'] = $_POST['penambahanstockchemical__packing'];
$data['qtyliterkg'] = $_POST['penambahanstockchemical__qtyliterkg'];
$data['notes'] = $_POST['penambahanstockchemical__notes'];
$data['lastupdate'] = $_POST['penambahanstockchemical__lastupdate'];
$data['updatedby'] = $_POST['penambahanstockchemical__updatedby'];
$data['created'] = $_POST['penambahanstockchemical__created'];
$data['createdby'] = $_POST['penambahanstockchemical__createdby'];
$this->db->where('id', $data['penambahan_stock_chemical_id']);
$this->db->update('penambahanstockchemical', $data);
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