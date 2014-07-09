<?php

class permintaan_stockedit extends Controller {

	function permintaan_stockedit()
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
	
		
$q = $this->db->where('id', $permintaan_stock_id);
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
$this->load->view('permintaan_stock_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['permintaanstock__idstring']) && ($_POST['permintaanstock__idstring'] == "" || $_POST['permintaanstock__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['permintaanstock__idstring'])) {$this->db->where("id !=", $_POST['permintaan_stock_id']);
$this->db->where('idstring', $_POST['permintaanstock__idstring']);
$q = $this->db->get('permintaanstock');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['permintaanstock__date']) && ($_POST['permintaanstock__date'] == "" || $_POST['permintaanstock__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['permintaanstock__idstring']))
$data['idstring'] = $_POST['permintaanstock__idstring'];if (isset($_POST['permintaanstock__date']))
$this->db->set('date', "str_to_date('".$_POST['permintaanstock__date']."', '%d-%m-%Y')", false);if (isset($_POST['permintaanstock__notes']))
$data['notes'] = $_POST['permintaanstock__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['permintaan_stock_id']);
$this->db->update('permintaanstock', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('permintaan_stockedit','permintaanstock','afteredit', $_POST['permintaan_stock_id']);
			
			
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