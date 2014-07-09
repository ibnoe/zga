<?php

class klaim_tunjangan_kesehatanadd extends Controller {

	function klaim_tunjangan_kesehatanadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['karyawan_id'] = $id;
$data['tunjangankesehatanusage__date'] = '';
$data['tunjangankesehatanusage__description'] = '';
$data['tunjangankesehatanusage__amount'] = '';
$data['tunjangankesehatanusage__amountpaid'] = '';
$data['tunjangankesehatanusage__notes'] = '';
$data['tunjangankesehatanusage__lastupdate'] = '';
$data['tunjangankesehatanusage__updatedby'] = '';
$data['tunjangankesehatanusage__created'] = '';
$data['tunjangankesehatanusage__createdby'] = '';
$karyawan = array();
$this->db->where('id', $id);
$q = $this->db->get('karyawan');
if ($q->num_rows() > 0)
$karyawan = $q->row_array();
$data['tunjangankesehatanusage__notes'] = $karyawan['notes'];
$data['tunjangankesehatanusage__lastupdate'] = $karyawan['lastupdate'];
$data['tunjangankesehatanusage__updatedby'] = $karyawan['updatedby'];
$data['tunjangankesehatanusage__created'] = $karyawan['created'];
$data['tunjangankesehatanusage__createdby'] = $karyawan['createdby'];
		

		$this->load->view('klaim_tunjangan_kesehatan_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['tunjangankesehatanusage__date']) && ($_POST['tunjangankesehatanusage__date'] == "" || $_POST['tunjangankesehatanusage__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['karyawan_id'] = $_POST['karyawan_id'];if (isset($_POST['tunjangankesehatanusage__date']))
$this->db->set('date', "str_to_date('".$_POST['tunjangankesehatanusage__date']."', '%d-%m-%Y')", false);if (isset($_POST['tunjangankesehatanusage__description']))
$data['description'] = $_POST['tunjangankesehatanusage__description'];if (isset($_POST['tunjangankesehatanusage__amount']))
$data['amount'] = $_POST['tunjangankesehatanusage__amount'];if (isset($_POST['tunjangankesehatanusage__amountpaid']))
$data['amountpaid'] = $_POST['tunjangankesehatanusage__amountpaid'];if (isset($_POST['tunjangankesehatanusage__notes']))
$data['notes'] = $_POST['tunjangankesehatanusage__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('tunjangankesehatanusage', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$tunjangankesehatanusage_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('klaim_tunjangan_kesehatanadd','tunjangankesehatanusage','aftersave', $tunjangankesehatanusage_id);
			
		
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