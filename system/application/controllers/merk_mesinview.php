<?php

class merk_mesinview extends Controller {

	function merk_mesinview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($merk_mesin_id=0)
	{
		if ($merk_mesin_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $merk_mesin_id);
$this->db->select('*');
$q = $this->db->get('merkmesin');
if ($q->num_rows() > 0) {
$data = array();
$data['merk_mesin_id'] = $merk_mesin_id;
foreach ($q->result() as $r) {
$data['merkmesin__idstring'] = $r->idstring;
$data['merkmesin__name'] = $r->name;
$data['merkmesin__lastupdate'] = $r->lastupdate;
$data['merkmesin__updatedby'] = $r->updatedby;
$data['merkmesin__created'] = $r->created;
$data['merkmesin__createdby'] = $r->createdby;}
$this->load->view('merk_mesin_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['merkmesin__idstring'];
$data['name'] = $_POST['merkmesin__name'];
$data['lastupdate'] = $_POST['merkmesin__lastupdate'];
$data['updatedby'] = $_POST['merkmesin__updatedby'];
$data['created'] = $_POST['merkmesin__created'];
$data['createdby'] = $_POST['merkmesin__createdby'];
$this->db->where('id', $data['merk_mesin_id']);
$this->db->update('merkmesin', $data);
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