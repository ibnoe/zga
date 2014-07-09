<?php

class permintaan_stock_chemicaledit extends Controller {

	function permintaan_stock_chemicaledit()
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
	
		
$q = $this->db->where('id', $permintaan_stock_chemical_id);
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
$this->load->view('permintaan_stock_chemical_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['permintaanstockchemical__idstring']) && ($_POST['permintaanstockchemical__idstring'] == "" || $_POST['permintaanstockchemical__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['permintaanstockchemical__idstring'])) {$this->db->where("id !=", $_POST['permintaan_stock_chemical_id']);
$this->db->where('idstring', $_POST['permintaanstockchemical__idstring']);
$q = $this->db->get('permintaanstockchemical');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['permintaanstockchemical__date']) && ($_POST['permintaanstockchemical__date'] == "" || $_POST['permintaanstockchemical__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['permintaanstockchemical__idstring']))
$data['idstring'] = $_POST['permintaanstockchemical__idstring'];if (isset($_POST['permintaanstockchemical__date']))
$this->db->set('date', "str_to_date('".$_POST['permintaanstockchemical__date']."', '%d-%m-%Y')", false);if (isset($_POST['permintaanstockchemical__notes']))
$data['notes'] = $_POST['permintaanstockchemical__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['permintaan_stock_chemical_id']);
$this->db->update('permintaanstockchemical', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('permintaan_stock_chemicaledit','permintaanstockchemical','afteredit', $_POST['permintaan_stock_chemical_id']);
			
			
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