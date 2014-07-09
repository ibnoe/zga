<?php

class merk_mesinedit extends Controller {

	function merk_mesinedit()
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
	
		
$q = $this->db->where('id', $merk_mesin_id);
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
$this->load->view('merk_mesin_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['merkmesin__idstring']) && ($_POST['merkmesin__idstring'] == "" || $_POST['merkmesin__idstring'] == null))
$error .= "<span class='error'>Kode Merk Mesin must not be empty"."</span><br>";

if (isset($_POST['merkmesin__idstring'])) {$this->db->where("id !=", $_POST['merk_mesin_id']);
$this->db->where('idstring', $_POST['merkmesin__idstring']);
$q = $this->db->get('merkmesin');
if ($q->num_rows() > 0) $error .= "<span class='error'>Kode Merk Mesin must be unique"."</span><br>";}

if (isset($_POST['merkmesin__name']) && ($_POST['merkmesin__name'] == "" || $_POST['merkmesin__name'] == null))
$error .= "<span class='error'>Merk Mesin must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['merkmesin__idstring']))
$data['idstring'] = $_POST['merkmesin__idstring'];if (isset($_POST['merkmesin__name']))
$data['name'] = $_POST['merkmesin__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['merk_mesin_id']);
$this->db->update('merkmesin', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('merk_mesinedit','merkmesin','afteredit', $_POST['merk_mesin_id']);
			
			
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