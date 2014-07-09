<?php

class permintaan_stockview extends Controller {

	function permintaan_stockview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($permintaan_stock_id=0)
	{
		if ($permintaan_stock_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $permintaan_stock_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('permintaanstock');
if ($q->num_rows() > 0) {
$data = array();
$data['permintaan_stock_id'] = $permintaan_stock_id;
foreach ($q->result() as $r) {
$data['permintaanstock__idstring'] = $r->idstring;
$data['permintaanstock__date'] = $r->date;
$data['permintaanstock__notes'] = $r->notes;
$data['permintaanstock__lastupdate'] = $r->lastupdate;
$data['permintaanstock__updatedby'] = $r->updatedby;
$data['permintaanstock__created'] = $r->created;
$data['permintaanstock__createdby'] = $r->createdby;}
$this->load->view('permintaan_stock_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['permintaanstock__idstring'];
$data['date'] = $_POST['permintaanstock__date'];
$data['notes'] = $_POST['permintaanstock__notes'];
$data['lastupdate'] = $_POST['permintaanstock__lastupdate'];
$data['updatedby'] = $_POST['permintaanstock__updatedby'];
$data['created'] = $_POST['permintaanstock__created'];
$data['createdby'] = $_POST['permintaanstock__createdby'];
$this->db->where('id', $data['permintaan_stock_id']);
$this->db->update('permintaanstock', $data);
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