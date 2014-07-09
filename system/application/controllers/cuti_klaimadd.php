<?php

class cuti_klaimadd extends Controller {

	function cuti_klaimadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['karyawan_id'] = $id;
$data['cutiklaim__date'] = '';
$data['cutiklaim__totalcutiklaimed'] = '';
$users_opt = array();
$users_opt[''] = 'None';
$q = $this->db->get('users');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $users_opt[$row->id] = $row->firstname; }
$data['users_opt'] = $users_opt;
$data['cutiklaim__users_id'] = '';
$data['cutiklaim__notes'] = '';
$data['cutiklaim__lastupdate'] = '';
$data['cutiklaim__updatedby'] = '';
$data['cutiklaim__created'] = '';
$data['cutiklaim__createdby'] = '';
$karyawan = array();
$this->db->where('id', $id);
$q = $this->db->get('karyawan');
if ($q->num_rows() > 0)
$karyawan = $q->row_array();
$data['cutiklaim__notes'] = $karyawan['notes'];
$data['cutiklaim__lastupdate'] = $karyawan['lastupdate'];
$data['cutiklaim__updatedby'] = $karyawan['updatedby'];
$data['cutiklaim__created'] = $karyawan['created'];
$data['cutiklaim__createdby'] = $karyawan['createdby'];
		

		$this->load->view('cuti_klaim_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['cutiklaim__date']) && ($_POST['cutiklaim__date'] == "" || $_POST['cutiklaim__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['cutiklaim__users_id']) || ($_POST['cutiklaim__users_id'] == "" || $_POST['cutiklaim__users_id'] == null  || $_POST['cutiklaim__users_id'] == null))
$error .= "<span class='error'>Atasan must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['karyawan_id'] = $_POST['karyawan_id'];if (isset($_POST['cutiklaim__date']))
$this->db->set('date', "str_to_date('".$_POST['cutiklaim__date']."', '%d-%m-%Y')", false);if (isset($_POST['cutiklaim__totalcutiklaimed']))
$data['totalcutiklaimed'] = $_POST['cutiklaim__totalcutiklaimed'];if (isset($_POST['cutiklaim__users_id']))
$data['users_id'] = $_POST['cutiklaim__users_id'];if (isset($_POST['cutiklaim__notes']))
$data['notes'] = $_POST['cutiklaim__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('cutiklaim', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$cutiklaim_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('cuti_klaimadd','cutiklaim','aftersave', $cutiklaim_id);
			
		
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