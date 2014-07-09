<?php

class sppedit extends Controller {

	function sppedit()
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
	
		
$q = $this->db->where('id', $spp_id);
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
$this->load->view('spp_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['suratpermintaanpembelian__orderid']) && ($_POST['suratpermintaanpembelian__orderid'] == "" || $_POST['suratpermintaanpembelian__orderid'] == null))
$error .= "<span class='error'>No SPP must not be empty"."</span><br>";

if (isset($_POST['suratpermintaanpembelian__orderid'])) {$this->db->where("id !=", $_POST['spp_id']);
$this->db->where('orderid', $_POST['suratpermintaanpembelian__orderid']);
$q = $this->db->get('suratpermintaanpembelian');
if ($q->num_rows() > 0) $error .= "<span class='error'>No SPP must be unique"."</span><br>";}

if (isset($_POST['suratpermintaanpembelian__date']) && ($_POST['suratpermintaanpembelian__date'] == "" || $_POST['suratpermintaanpembelian__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['suratpermintaanpembelian__orderid']))
$data['orderid'] = $_POST['suratpermintaanpembelian__orderid'];if (isset($_POST['suratpermintaanpembelian__date']))
$this->db->set('date', "str_to_date('".$_POST['suratpermintaanpembelian__date']."', '%d-%m-%Y')", false);if (isset($_POST['suratpermintaanpembelian__requester']))
$data['requester'] = $_POST['suratpermintaanpembelian__requester'];if (isset($_POST['suratpermintaanpembelian__divisi']))
$data['divisi'] = $_POST['suratpermintaanpembelian__divisi'];if (isset($_POST['suratpermintaanpembelian__buysource']))
$data['buysource'] = $_POST['suratpermintaanpembelian__buysource'];if (isset($_POST['suratpermintaanpembelian__notes']))
$data['notes'] = $_POST['suratpermintaanpembelian__notes'];if (isset($_POST['suratpermintaanpembelian__status']))
$data['status'] = $_POST['suratpermintaanpembelian__status'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['spp_id']);
$this->db->update('suratpermintaanpembelian', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sppedit','suratpermintaanpembelian','afteredit', $_POST['spp_id']);
			
			
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