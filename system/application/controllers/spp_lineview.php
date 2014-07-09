<?php

class spp_lineview extends Controller {

	function spp_lineview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($spp_line_id=0)
	{
		if ($spp_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $spp_line_id);
$this->db->select('*');
$q = $this->db->get('suratpermintaanpembelianline');
if ($q->num_rows() > 0) {
$data = array();
$data['spp_line_id'] = $spp_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['suratpermintaanpembelianline__item_id'] = $r->item_id;
$data['suratpermintaanpembelianline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['suratpermintaanpembelianline__uom_id'] = $r->uom_id;
$data['suratpermintaanpembelianline__lastupdate'] = $r->lastupdate;
$data['suratpermintaanpembelianline__updatedby'] = $r->updatedby;
$data['suratpermintaanpembelianline__created'] = $r->created;
$data['suratpermintaanpembelianline__createdby'] = $r->createdby;}
$this->load->view('spp_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['item_id'] = $_POST['suratpermintaanpembelianline__item_id'];
$data['quantity'] = $_POST['suratpermintaanpembelianline__quantity'];
$data['uom_id'] = $_POST['suratpermintaanpembelianline__uom_id'];
$data['lastupdate'] = $_POST['suratpermintaanpembelianline__lastupdate'];
$data['updatedby'] = $_POST['suratpermintaanpembelianline__updatedby'];
$data['created'] = $_POST['suratpermintaanpembelianline__created'];
$data['createdby'] = $_POST['suratpermintaanpembelianline__createdby'];
$this->db->where('id', $data['spp_line_id']);
$this->db->update('suratpermintaanpembelianline', $data);
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