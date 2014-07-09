<?php

class uploaded_pricelistedit extends Controller {

	function uploaded_pricelistedit()
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
	
		
$q = $this->db->where('id', $uploaded_pricelist_id);
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
$this->load->view('uploaded_pricelist_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['uploadedpricelist__name']) && ($_POST['uploadedpricelist__name'] == "" || $_POST['uploadedpricelist__name'] == null))
$error .= "<span class='error'>File must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
if (isset($_FILES['uploadedpricelist__name']) && $_FILES['uploadedpricelist__name']['tmp_name'] != null && $_FILES['uploadedpricelist__name']['tmp_name'] != ""){$filepath = 'upload//'.$_FILES['uploadedpricelist__name']['name'];move_uploaded_file($_FILES['uploadedpricelist__name']['tmp_name'], $filepath);$data['name'] = $_FILES['uploadedpricelist__name']['name'];}if (isset($_POST['uploadedpricelist__notes']))
$data['notes'] = $_POST['uploadedpricelist__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['uploaded_pricelist_id']);
$this->db->update('uploadedpricelist', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('uploaded_pricelistedit','uploadedpricelist','afteredit', $_POST['uploaded_pricelist_id']);
			
			
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