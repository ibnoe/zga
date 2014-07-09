<?php

class item_categoryedit extends Controller {

	function item_categoryedit()
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
	
		
$q = $this->db->where('id', $item_category_id);
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
$this->load->view('item_category_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['itemcategory__name']) && ($_POST['itemcategory__name'] == "" || $_POST['itemcategory__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['itemcategory__name']))
$data['name'] = $_POST['itemcategory__name'];if (isset($_POST['itemcategory__notes']))
$data['notes'] = $_POST['itemcategory__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['item_category_id']);
$this->db->update('itemcategory', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('item_categoryedit','itemcategory','afteredit', $_POST['item_category_id']);
			
			
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