<?php

class price_listview extends Controller {

	function price_listview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($price_list_id=0)
	{
		if ($price_list_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $price_list_id);
$this->db->select('*');
$q = $this->db->get('pricelist');
if ($q->num_rows() > 0) {
$data = array();
$data['price_list_id'] = $price_list_id;
foreach ($q->result() as $r) {
$data['pricelist__idstring'] = $r->idstring;
$data['pricelist__name'] = $r->name;
$data['pricelist__lastupdate'] = $r->lastupdate;
$data['pricelist__updatedby'] = $r->updatedby;
$data['pricelist__created'] = $r->created;
$data['pricelist__createdby'] = $r->createdby;}
$this->load->view('price_list_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['idstring'] = $_POST['pricelist__idstring'];
$data['name'] = $_POST['pricelist__name'];
$data['lastupdate'] = $_POST['pricelist__lastupdate'];
$data['updatedby'] = $_POST['pricelist__updatedby'];
$data['created'] = $_POST['pricelist__created'];
$data['createdby'] = $_POST['pricelist__createdby'];
$this->db->where('id', $data['price_list_id']);
$this->db->update('pricelist', $data);
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