<?php

class item_categoryadd extends Controller {

	function item_categoryadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['itemcategory__name'] = '';
$data['itemcategory__notes'] = '';
$data['itemcategory__lastupdate'] = '';
$data['itemcategory__updatedby'] = '';
$data['itemcategory__created'] = '';
$data['itemcategory__createdby'] = '';
		

		$this->load->view('item_category_add_form', $data);
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
$this->db->insert('itemcategory', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$itemcategory_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('item_categoryadd','itemcategory','aftersave', $itemcategory_id);
			
		
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
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