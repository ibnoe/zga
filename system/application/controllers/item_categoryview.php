<?php

class item_categoryview extends Controller {

	function item_categoryview()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($item_category_id=0)
	{
		if ($item_category_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$this->db->where('id', $item_category_id);
$this->db->select('*');
$q = $this->db->get('itemcategory');
if ($q->num_rows() > 0) {
$data = array();
$data['item_category_id'] = $item_category_id;
foreach ($q->result() as $r) {
$data['itemcategory__name'] = $r->name;
$data['itemcategory__notes'] = $r->notes;
$data['itemcategory__lastupdate'] = $r->lastupdate;
$data['itemcategory__updatedby'] = $r->updatedby;
$data['itemcategory__created'] = $r->created;
$data['itemcategory__createdby'] = $r->createdby;}
$this->load->view('item_category_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['name'] = $_POST['itemcategory__name'];
$data['notes'] = $_POST['itemcategory__notes'];
$data['lastupdate'] = $_POST['itemcategory__lastupdate'];
$data['updatedby'] = $_POST['itemcategory__updatedby'];
$data['created'] = $_POST['itemcategory__created'];
$data['createdby'] = $_POST['itemcategory__createdby'];
$this->db->where('id', $data['item_category_id']);
$this->db->update('itemcategory', $data);
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