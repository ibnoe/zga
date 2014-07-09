<?php

class sppadd extends Controller {

	function sppadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['suratpermintaanpembelian__orderid'] = '';$this->load->library('generallib');
$data['suratpermintaanpembelian__orderid'] = $this->generallib->genId('SPP');
$data['suratpermintaanpembelian__date'] = '';
$data['suratpermintaanpembelian__requester'] = '';
$data['suratpermintaanpembelian__divisi'] = '';
$data['suratpermintaanpembelian__buysource'] = '';
$data['suratpermintaanpembelian__notes'] = '';
$data['suratpermintaanpembelian__status'] = '';
$data['suratpermintaanpembelian__lastupdate'] = '';
$data['suratpermintaanpembelian__updatedby'] = '';
$data['suratpermintaanpembelian__created'] = '';
$data['suratpermintaanpembelian__createdby'] = '';
		

		$this->load->view('spp_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['suratpermintaanpembelian__orderid']) && ($_POST['suratpermintaanpembelian__orderid'] == "" || $_POST['suratpermintaanpembelian__orderid'] == null))
$error .= "<span class='error'>No SPP must not be empty"."</span><br>";

if (isset($_POST['suratpermintaanpembelian__orderid'])) {
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
$this->db->insert('suratpermintaanpembelian', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$suratpermintaanpembelian_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sppadd','suratpermintaanpembelian','aftersave', $suratpermintaanpembelian_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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