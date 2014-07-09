<?php

class karyawanedit extends Controller {

	function karyawanedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($karyawan_id=0)
	{
		if ($karyawan_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $karyawan_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(dob, "%d-%m-%Y") as dob', false);
$this->db->select('DATE_FORMAT(joindate, "%d-%m-%Y") as joindate', false);
$this->db->select('DATE_FORMAT(endprobationdate, "%d-%m-%Y") as endprobationdate', false);
$q = $this->db->get('karyawan');
if ($q->num_rows() > 0) {
$data = array();
$data['karyawan_id'] = $karyawan_id;
foreach ($q->result() as $r) {
$data['karyawan__idstring'] = $r->idstring;
$data['karyawan__name'] = $r->name;
$data['karyawan__gender'] = $r->gender;
$data['karyawan__address'] = $r->address;
$data['karyawan__phone1'] = $r->phone1;
$data['karyawan__phone2'] = $r->phone2;
$data['karyawan__dob'] = $r->dob;
$data['karyawan__education'] = $r->education;
$data['karyawan__religion'] = $r->religion;
$data['karyawan__joindate'] = $r->joindate;
$data['karyawan__department'] = $r->department;
$data['karyawan__gol'] = $r->gol;
$data['karyawan__endprobationdate'] = $r->endprobationdate;
$data['karyawan__rekbca'] = $r->rekbca;
$data['karyawan__cabbca'] = $r->cabbca;
$data['karyawan__notes'] = $r->notes;
$data['karyawan__status'] = $r->status;
$data['karyawan__lastupdate'] = $r->lastupdate;
$data['karyawan__updatedby'] = $r->updatedby;
$data['karyawan__created'] = $r->created;
$data['karyawan__createdby'] = $r->createdby;}
$this->load->view('karyawan_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['karyawan__idstring']) && ($_POST['karyawan__idstring'] == "" || $_POST['karyawan__idstring'] == null))
$error .= "<span class='error'>NIK must not be empty"."</span><br>";

if (isset($_POST['karyawan__idstring'])) {$this->db->where("id !=", $_POST['karyawan_id']);
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
$this->db->where('id', $_POST['karyawan_id']);
$this->db->update('karyawan', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('karyawanedit','karyawan','afteredit', $_POST['karyawan_id']);
			
			
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