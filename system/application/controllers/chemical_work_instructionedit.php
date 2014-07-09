<?php

class chemical_work_instructionedit extends Controller {

	function chemical_work_instructionedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($chemical_work_instruction_id=0)
	{
		if ($chemical_work_instruction_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $chemical_work_instruction_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('chemicalworkinstruction');
if ($q->num_rows() > 0) {
$data = array();
$data['chemical_work_instruction_id'] = $chemical_work_instruction_id;
foreach ($q->result() as $r) {
$data['chemicalworkinstruction__idstring'] = $r->idstring;
$data['chemicalworkinstruction__date'] = $r->date;
$data['chemicalworkinstruction__name'] = $r->name;
$data['chemicalworkinstruction__joborderno'] = $r->joborderno;
$data['chemicalworkinstruction__packing'] = $r->packing;
$data['chemicalworkinstruction__qtyliterkg'] = $r->qtyliterkg;
$data['chemicalworkinstruction__notes'] = $r->notes;
$data['chemicalworkinstruction__lastupdate'] = $r->lastupdate;
$data['chemicalworkinstruction__updatedby'] = $r->updatedby;
$data['chemicalworkinstruction__created'] = $r->created;
$data['chemicalworkinstruction__createdby'] = $r->createdby;}
$this->load->view('chemical_work_instruction_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['chemicalworkinstruction__idstring']) && ($_POST['chemicalworkinstruction__idstring'] == "" || $_POST['chemicalworkinstruction__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['chemicalworkinstruction__idstring'])) {$this->db->where("id !=", $_POST['chemical_work_instruction_id']);
$this->db->where('idstring', $_POST['chemicalworkinstruction__idstring']);
$q = $this->db->get('chemicalworkinstruction');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['chemicalworkinstruction__date']) && ($_POST['chemicalworkinstruction__date'] == "" || $_POST['chemicalworkinstruction__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['chemicalworkinstruction__name']) && ($_POST['chemicalworkinstruction__name'] == "" || $_POST['chemicalworkinstruction__name'] == null))
$error .= "<span class='error'>Product Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['chemicalworkinstruction__idstring']))
$data['idstring'] = $_POST['chemicalworkinstruction__idstring'];if (isset($_POST['chemicalworkinstruction__date']))
$this->db->set('date', "str_to_date('".$_POST['chemicalworkinstruction__date']."', '%d-%m-%Y')", false);if (isset($_POST['chemicalworkinstruction__name']))
$data['name'] = $_POST['chemicalworkinstruction__name'];if (isset($_POST['chemicalworkinstruction__joborderno']))
$data['joborderno'] = $_POST['chemicalworkinstruction__joborderno'];if (isset($_POST['chemicalworkinstruction__packing']))
$data['packing'] = $_POST['chemicalworkinstruction__packing'];if (isset($_POST['chemicalworkinstruction__qtyliterkg']))
$data['qtyliterkg'] = $_POST['chemicalworkinstruction__qtyliterkg'];if (isset($_POST['chemicalworkinstruction__notes']))
$data['notes'] = $_POST['chemicalworkinstruction__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['chemical_work_instruction_id']);
$this->db->update('chemicalworkinstruction', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('chemical_work_instructionedit','chemicalworkinstruction','afteredit', $_POST['chemical_work_instruction_id']);
			
			
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