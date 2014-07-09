<?php

class penambahan_stock_chemicaledit extends Controller {

	function penambahan_stock_chemicaledit()
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
	
		
$q = $this->db->where('id', $penambahan_stock_chemical_id);
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
$this->load->view('penambahan_stock_chemical_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['penambahanstockchemical__idstring']) && ($_POST['penambahanstockchemical__idstring'] == "" || $_POST['penambahanstockchemical__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['penambahanstockchemical__idstring'])) {$this->db->where("id !=", $_POST['penambahan_stock_chemical_id']);
$this->db->where('idstring', $_POST['penambahanstockchemical__idstring']);
$q = $this->db->get('penambahanstockchemical');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['penambahanstockchemical__date']) && ($_POST['penambahanstockchemical__date'] == "" || $_POST['penambahanstockchemical__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['penambahanstockchemical__name']) && ($_POST['penambahanstockchemical__name'] == "" || $_POST['penambahanstockchemical__name'] == null))
$error .= "<span class='error'>Product Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['penambahanstockchemical__idstring']))
$data['idstring'] = $_POST['penambahanstockchemical__idstring'];if (isset($_POST['penambahanstockchemical__date']))
$this->db->set('date', "str_to_date('".$_POST['penambahanstockchemical__date']."', '%d-%m-%Y')", false);if (isset($_POST['penambahanstockchemical__name']))
$data['name'] = $_POST['penambahanstockchemical__name'];if (isset($_POST['penambahanstockchemical__joborderno']))
$data['joborderno'] = $_POST['penambahanstockchemical__joborderno'];if (isset($_POST['penambahanstockchemical__batchno']))
$data['batchno'] = $_POST['penambahanstockchemical__batchno'];if (isset($_POST['penambahanstockchemical__packing']))
$data['packing'] = $_POST['penambahanstockchemical__packing'];if (isset($_POST['penambahanstockchemical__qtyliterkg']))
$data['qtyliterkg'] = $_POST['penambahanstockchemical__qtyliterkg'];if (isset($_POST['penambahanstockchemical__notes']))
$data['notes'] = $_POST['penambahanstockchemical__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['penambahan_stock_chemical_id']);
$this->db->update('penambahanstockchemical', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('penambahan_stock_chemicaledit','penambahanstockchemical','afteredit', $_POST['penambahan_stock_chemical_id']);
			
			
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