<?php

class penambahan_stock_chemicaladd extends Controller {

	function penambahan_stock_chemicaladd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['penambahanstockchemical__idstring'] = '';$this->load->library('generallib');
$data['penambahanstockchemical__idstring'] = $this->generallib->genId('Penambahan Stock Chemical');
$data['penambahanstockchemical__date'] = '';
$data['penambahanstockchemical__name'] = '';
$data['penambahanstockchemical__joborderno'] = '';
$data['penambahanstockchemical__batchno'] = '';
$data['penambahanstockchemical__packing'] = '';
$data['penambahanstockchemical__qtyliterkg'] = '';
$data['penambahanstockchemical__notes'] = '';
$data['penambahanstockchemical__lastupdate'] = '';
$data['penambahanstockchemical__updatedby'] = '';
$data['penambahanstockchemical__created'] = '';
$data['penambahanstockchemical__createdby'] = '';
		

		$this->load->view('penambahan_stock_chemical_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['penambahanstockchemical__idstring']) && ($_POST['penambahanstockchemical__idstring'] == "" || $_POST['penambahanstockchemical__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['penambahanstockchemical__idstring'])) {
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
$this->db->insert('penambahanstockchemical', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$penambahanstockchemical_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('penambahan_stock_chemicaladd','penambahanstockchemical','aftersave', $penambahanstockchemical_id);
			
		
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