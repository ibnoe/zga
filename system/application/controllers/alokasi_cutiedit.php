<?php

class alokasi_cutiedit extends Controller {

	function alokasi_cutiedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($alokasi_cuti_id=0)
	{
		if ($alokasi_cuti_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $alokasi_cuti_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(begindate, "%d-%m-%Y") as begindate', false);
$q = $this->db->get('cutiallowance');
if ($q->num_rows() > 0) {
$data = array();
$data['alokasi_cuti_id'] = $alokasi_cuti_id;
foreach ($q->result() as $r) {
$data['cutiallowance__begindate'] = $r->begindate;
$data['cutiallowance__totalcuti'] = $r->totalcuti;
$data['cutiallowance__notes'] = $r->notes;
$data['cutiallowance__lastupdate'] = $r->lastupdate;
$data['cutiallowance__updatedby'] = $r->updatedby;
$data['cutiallowance__created'] = $r->created;
$data['cutiallowance__createdby'] = $r->createdby;}
$this->load->view('alokasi_cuti_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['cutiallowance__begindate']) && ($_POST['cutiallowance__begindate'] == "" || $_POST['cutiallowance__begindate'] == null))
$error .= "<span class='error'>Start Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['cutiallowance__begindate']))
$this->db->set('begindate', "str_to_date('".$_POST['cutiallowance__begindate']."', '%d-%m-%Y')", false);if (isset($_POST['cutiallowance__totalcuti']))
$data['totalcuti'] = $_POST['cutiallowance__totalcuti'];if (isset($_POST['cutiallowance__notes']))
$data['notes'] = $_POST['cutiallowance__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['alokasi_cuti_id']);
$this->db->update('cutiallowance', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('alokasi_cutiedit','cutiallowance','afteredit', $_POST['alokasi_cuti_id']);
			
			
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