<?php

class bill_of_materialview extends Controller {

	function bill_of_materialview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($bill_of_material_id=0)
	{
		if ($bill_of_material_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $bill_of_material_id);
$this->db->select('*');
$q = $this->db->get('bom');
if ($q->num_rows() > 0) {
$data = array();
$data['bill_of_material_id'] = $bill_of_material_id;
foreach ($q->result() as $r) {
$data['bom__name'] = $r->name;
$data['bom__lastupdate'] = $r->lastupdate;
$data['bom__updatedby'] = $r->updatedby;
$data['bom__created'] = $r->created;
$data['bom__createdby'] = $r->createdby;}
$this->load->view('bill_of_material_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['bom__name'];
$data['lastupdate'] = $_POST['bom__lastupdate'];
$data['updatedby'] = $_POST['bom__updatedby'];
$data['created'] = $_POST['bom__created'];
$data['createdby'] = $_POST['bom__createdby'];
$this->db->where('id', $data['bill_of_material_id']);
$this->db->update('bom', $data);
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