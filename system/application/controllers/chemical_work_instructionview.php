<?php

class chemical_work_instructionview extends Controller {

	function chemical_work_instructionview()
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
	
		
$this->db->where('id', $chemical_work_instruction_id);
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
$this->load->view('chemical_work_instruction_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['chemicalworkinstruction__idstring'];
$data['date'] = $_POST['chemicalworkinstruction__date'];
$data['name'] = $_POST['chemicalworkinstruction__name'];
$data['joborderno'] = $_POST['chemicalworkinstruction__joborderno'];
$data['packing'] = $_POST['chemicalworkinstruction__packing'];
$data['qtyliterkg'] = $_POST['chemicalworkinstruction__qtyliterkg'];
$data['notes'] = $_POST['chemicalworkinstruction__notes'];
$data['lastupdate'] = $_POST['chemicalworkinstruction__lastupdate'];
$data['updatedby'] = $_POST['chemicalworkinstruction__updatedby'];
$data['created'] = $_POST['chemicalworkinstruction__created'];
$data['createdby'] = $_POST['chemicalworkinstruction__createdby'];
$this->db->where('id', $data['chemical_work_instruction_id']);
$this->db->update('chemicalworkinstruction', $data);
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