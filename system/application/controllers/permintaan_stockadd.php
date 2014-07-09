<?php

class permintaan_stockadd extends Controller {

	function permintaan_stockadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['permintaanstock__idstring'] = '';$this->load->library('generallib');
$data['permintaanstock__idstring'] = $this->generallib->genId('Permintaan Stock');
$data['permintaanstock__date'] = '';
$data['permintaanstock__notes'] = '';
$data['permintaanstock__lastupdate'] = '';
$data['permintaanstock__updatedby'] = '';
$data['permintaanstock__created'] = '';
$data['permintaanstock__createdby'] = '';
		

		$this->load->view('permintaan_stock_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['permintaanstock__idstring']) && ($_POST['permintaanstock__idstring'] == "" || $_POST['permintaanstock__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['permintaanstock__idstring'])) {
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
$this->db->insert('permintaanstock', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$permintaanstock_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('permintaan_stockadd','permintaanstock','aftersave', $permintaanstock_id);
			
		
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