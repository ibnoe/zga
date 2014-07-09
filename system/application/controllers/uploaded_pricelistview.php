<?php

class uploaded_pricelistview extends Controller {

	function uploaded_pricelistview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($uploaded_pricelist_id=0)
	{
		if ($uploaded_pricelist_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $uploaded_pricelist_id);
$this->db->select('*');
$q = $this->db->get('uploadedpricelist');
if ($q->num_rows() > 0) {
$data = array();
$data['uploaded_pricelist_id'] = $uploaded_pricelist_id;
foreach ($q->result() as $r) {
$data['uploadedpricelist__name'] = $r->name;
$data['uploadedpricelist__notes'] = $r->notes;
$data['uploadedpricelist__lastupdate'] = $r->lastupdate;
$data['uploadedpricelist__updatedby'] = $r->updatedby;
$data['uploadedpricelist__created'] = $r->created;
$data['uploadedpricelist__createdby'] = $r->createdby;}
$this->load->view('uploaded_pricelist_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
if (isset($_FILES['name'])){$filepath = 'penawarandocs/'.$_FILES['name']['name'];move_uploaded_file($_FILES['name']['tmp_name'], $filepath);}
$data['name'] = $_POST['uploadedpricelist__name'];
$data['notes'] = $_POST['uploadedpricelist__notes'];
$data['lastupdate'] = $_POST['uploadedpricelist__lastupdate'];
$data['updatedby'] = $_POST['uploadedpricelist__updatedby'];
$data['created'] = $_POST['uploadedpricelist__created'];
$data['createdby'] = $_POST['uploadedpricelist__createdby'];
$this->db->where('id', $data['uploaded_pricelist_id']);
$this->db->update('uploadedpricelist', $data);
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