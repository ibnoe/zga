<?php

class karyawanadd extends Controller {

	function karyawanadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['karyawan__idstring'] = '';
$data['karyawan__name'] = '';
$data['karyawan__gender'] = '';
$data['karyawan__address'] = '';
$data['karyawan__phone1'] = '';
$data['karyawan__phone2'] = '';
$data['karyawan__dob'] = '';
$data['karyawan__education'] = '';
$data['karyawan__religion'] = '';
$data['karyawan__joindate'] = '';
$data['karyawan__department'] = '';
$data['karyawan__gol'] = '';
$data['karyawan__endprobationdate'] = '';
$data['karyawan__rekbca'] = '';
$data['karyawan__cabbca'] = '';
$data['karyawan__notes'] = '';
$data['karyawan__status'] = '';
$data['karyawan__lastupdate'] = '';
$data['karyawan__updatedby'] = '';
$data['karyawan__created'] = '';
$data['karyawan__createdby'] = '';
		

		$this->load->view('karyawan_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['karyawan__idstring']) && ($_POST['karyawan__idstring'] == "" || $_POST['karyawan__idstring'] == null))
$error .= "<span class='error'>NIK must not be empty"."</span><br>";

if (isset($_POST['karyawan__idstring'])) {
$this->db->where('idstring', $_POST['karyawan__idstring']);
$q = $this->db->get('karyawan');
if ($q->num_rows() > 0) $error .= "<span class='error'>NIK must be unique"."</span><br>";}

if (isset($_POST['karyawan__name']) && ($_POST['karyawan__name'] == "" || $_POST['karyawan__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

if (isset($_POST['karyawan__dob']) && ($_POST['karyawan__dob'] == "" || $_POST['karyawan__dob'] == null))
$error .= "<span class='error'>DOB must not be empty"."</span><br>";

if (isset($_POST['karyawan__joindate']) && ($_POST['karyawan__joindate'] == "" || $_POST['karyawan__joindate'] == null))
$error .= "<span class='error'>Join Date must not be empty"."</span><br>";

if (isset($_POST['karyawan__endprobationdate']) && ($_POST['karyawan__endprobationdate'] == "" || $_POST['karyawan__endprobationdate'] == null))
$error .= "<span class='error'>End Probation Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['karyawan__idstring']))
$data['idstring'] = $_POST['karyawan__idstring'];if (isset($_POST['karyawan__name']))
$data['name'] = $_POST['karyawan__name'];if (isset($_POST['karyawan__gender']))
$data['gender'] = $_POST['karyawan__gender'];if (isset($_POST['karyawan__address']))
$data['address'] = $_POST['karyawan__address'];if (isset($_POST['karyawan__phone1']))
$data['phone1'] = $_POST['karyawan__phone1'];if (isset($_POST['karyawan__phone2']))
$data['phone2'] = $_POST['karyawan__phone2'];if (isset($_POST['karyawan__dob']))
$this->db->set('dob', "str_to_date('".$_POST['karyawan__dob']."', '%d-%m-%Y')", false);if (isset($_POST['karyawan__education']))
$data['education'] = $_POST['karyawan__education'];if (isset($_POST['karyawan__religion']))
$data['religion'] = $_POST['karyawan__religion'];if (isset($_POST['karyawan__joindate']))
$this->db->set('joindate', "str_to_date('".$_POST['karyawan__joindate']."', '%d-%m-%Y')", false);if (isset($_POST['karyawan__department']))
$data['department'] = $_POST['karyawan__department'];if (isset($_POST['karyawan__gol']))
$data['gol'] = $_POST['karyawan__gol'];if (isset($_POST['karyawan__endprobationdate']))
$this->db->set('endprobationdate', "str_to_date('".$_POST['karyawan__endprobationdate']."', '%d-%m-%Y')", false);if (isset($_POST['karyawan__rekbca']))
$data['rekbca'] = $_POST['karyawan__rekbca'];if (isset($_POST['karyawan__cabbca']))
$data['cabbca'] = $_POST['karyawan__cabbca'];if (isset($_POST['karyawan__notes']))
$data['notes'] = $_POST['karyawan__notes'];if (isset($_POST['karyawan__status']))
$data['status'] = $_POST['karyawan__status'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('karyawan', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$karyawan_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('karyawanadd','karyawan','aftersave', $karyawan_id);
			
		
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