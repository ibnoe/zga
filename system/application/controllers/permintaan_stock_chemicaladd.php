<?php

class permintaan_stock_chemicaladd extends Controller {

	function permintaan_stock_chemicaladd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['permintaanstockchemical__idstring'] = '';$this->load->library('generallib');
$data['permintaanstockchemical__idstring'] = $this->generallib->genId('Permintaan Stock Chemical');
$data['permintaanstockchemical__date'] = '';
$data['permintaanstockchemical__notes'] = '';
$data['permintaanstockchemical__lastupdate'] = '';
$data['permintaanstockchemical__updatedby'] = '';
$data['permintaanstockchemical__created'] = '';
$data['permintaanstockchemical__createdby'] = '';
		

		$this->load->view('permintaan_stock_chemical_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['permintaanstockchemical__idstring']) && ($_POST['permintaanstockchemical__idstring'] == "" || $_POST['permintaanstockchemical__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['permintaanstockchemical__idstring'])) {
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
$this->db->insert('permintaanstockchemical', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$permintaanstockchemical_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('permintaan_stock_chemicaladd','permintaanstockchemical','aftersave', $permintaanstockchemical_id);
			
		
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