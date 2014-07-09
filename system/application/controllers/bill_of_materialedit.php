<?php

class bill_of_materialedit extends Controller {

	function bill_of_materialedit()
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
	
		
$q = $this->db->where('id', $bill_of_material_id);
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
$this->load->view('bill_of_material_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['bom__name']) && ($_POST['bom__name'] == "" || $_POST['bom__name'] == null))
$error .= "<span class='error'>Bill Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['bom__name']))
$data['name'] = $_POST['bom__name'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['bill_of_material_id']);
$this->db->update('bom', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('bill_of_materialedit','bom','afteredit', $_POST['bill_of_material_id']);
			
			
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