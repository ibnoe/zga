<?php

class alokasi_cutiadd extends Controller {

	function alokasi_cutiadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['karyawan_id'] = $id;
$data['cutiallowance__begindate'] = '';
$data['cutiallowance__totalcuti'] = '';
$data['cutiallowance__notes'] = '';
$data['cutiallowance__lastupdate'] = '';
$data['cutiallowance__updatedby'] = '';
$data['cutiallowance__created'] = '';
$data['cutiallowance__createdby'] = '';
$karyawan = array();
$this->db->where('id', $id);
$q = $this->db->get('karyawan');
if ($q->num_rows() > 0)
$karyawan = $q->row_array();
$data['cutiallowance__notes'] = $karyawan['notes'];
$data['cutiallowance__lastupdate'] = $karyawan['lastupdate'];
$data['cutiallowance__updatedby'] = $karyawan['updatedby'];
$data['cutiallowance__created'] = $karyawan['created'];
$data['cutiallowance__createdby'] = $karyawan['createdby'];
		

		$this->load->view('alokasi_cuti_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['cutiallowance__begindate']) && ($_POST['cutiallowance__begindate'] == "" || $_POST['cutiallowance__begindate'] == null))
$error .= "<span class='error'>Start Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['karyawan_id'] = $_POST['karyawan_id'];if (isset($_POST['cutiallowance__begindate']))
$this->db->set('begindate', "str_to_date('".$_POST['cutiallowance__begindate']."', '%d-%m-%Y')", false);if (isset($_POST['cutiallowance__totalcuti']))
$data['totalcuti'] = $_POST['cutiallowance__totalcuti'];if (isset($_POST['cutiallowance__notes']))
$data['notes'] = $_POST['cutiallowance__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('cutiallowance', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$cutiallowance_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('alokasi_cutiadd','cutiallowance','aftersave', $cutiallowance_id);
			
		
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