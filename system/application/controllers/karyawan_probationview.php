<?php

class karyawan_probationview extends Controller {

	function karyawan_probationview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($karyawan_probation_id=0)
	{
		if ($karyawan_probation_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $karyawan_probation_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(dob, "%d-%m-%Y") as dob', false);
$this->db->select('DATE_FORMAT(joindate, "%d-%m-%Y") as joindate', false);
$this->db->select('DATE_FORMAT(endprobationdate, "%d-%m-%Y") as endprobationdate', false);
$q = $this->db->get('karyawan');
if ($q->num_rows() > 0) {
$data = array();
$data['karyawan_probation_id'] = $karyawan_probation_id;
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
$this->load->view('karyawan_probation_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['karyawan__idstring'];
$data['name'] = $_POST['karyawan__name'];
$data['gender'] = $_POST['karyawan__gender'];
$data['address'] = $_POST['karyawan__address'];
$data['phone1'] = $_POST['karyawan__phone1'];
$data['phone2'] = $_POST['karyawan__phone2'];
$data['dob'] = $_POST['karyawan__dob'];
$data['education'] = $_POST['karyawan__education'];
$data['religion'] = $_POST['karyawan__religion'];
$data['joindate'] = $_POST['karyawan__joindate'];
$data['department'] = $_POST['karyawan__department'];
$data['gol'] = $_POST['karyawan__gol'];
$data['endprobationdate'] = $_POST['karyawan__endprobationdate'];
$data['rekbca'] = $_POST['karyawan__rekbca'];
$data['cabbca'] = $_POST['karyawan__cabbca'];
$data['notes'] = $_POST['karyawan__notes'];
$data['status'] = $_POST['karyawan__status'];
$data['lastupdate'] = $_POST['karyawan__lastupdate'];
$data['updatedby'] = $_POST['karyawan__updatedby'];
$data['created'] = $_POST['karyawan__created'];
$data['createdby'] = $_POST['karyawan__createdby'];
$this->db->where('id', $data['karyawan_probation_id']);
$this->db->update('karyawan', $data);
			validationonserver();
			
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