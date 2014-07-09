<?php

class sppview extends Controller {

	function sppview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($spp_id=0)
	{
		if ($spp_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $spp_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('suratpermintaanpembelian');
if ($q->num_rows() > 0) {
$data = array();
$data['spp_id'] = $spp_id;
foreach ($q->result() as $r) {
$data['suratpermintaanpembelian__orderid'] = $r->orderid;
$data['suratpermintaanpembelian__date'] = $r->date;
$data['suratpermintaanpembelian__requester'] = $r->requester;
$data['suratpermintaanpembelian__divisi'] = $r->divisi;
$data['suratpermintaanpembelian__buysource'] = $r->buysource;
$data['suratpermintaanpembelian__notes'] = $r->notes;
$data['suratpermintaanpembelian__status'] = $r->status;
$data['suratpermintaanpembelian__lastupdate'] = $r->lastupdate;
$data['suratpermintaanpembelian__updatedby'] = $r->updatedby;
$data['suratpermintaanpembelian__created'] = $r->created;
$data['suratpermintaanpembelian__createdby'] = $r->createdby;}
$this->load->view('spp_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['orderid'] = $_POST['suratpermintaanpembelian__orderid'];
$data['date'] = $_POST['suratpermintaanpembelian__date'];
$data['requester'] = $_POST['suratpermintaanpembelian__requester'];
$data['divisi'] = $_POST['suratpermintaanpembelian__divisi'];
$data['buysource'] = $_POST['suratpermintaanpembelian__buysource'];
$data['notes'] = $_POST['suratpermintaanpembelian__notes'];
$data['status'] = $_POST['suratpermintaanpembelian__status'];
$data['lastupdate'] = $_POST['suratpermintaanpembelian__lastupdate'];
$data['updatedby'] = $_POST['suratpermintaanpembelian__updatedby'];
$data['created'] = $_POST['suratpermintaanpembelian__created'];
$data['createdby'] = $_POST['suratpermintaanpembelian__createdby'];
$this->db->where('id', $data['spp_id']);
$this->db->update('suratpermintaanpembelian', $data);
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