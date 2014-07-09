<?php

class warehouseadd extends Controller {

	function warehouseadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['warehouse__name'] = '';
$data['warehouse__address'] = '';
$data['warehouse__phone'] = '';
$data['warehouse__fax'] = '';
$data['warehouse__lastupdate'] = '';
$data['warehouse__updatedby'] = '';
$data['warehouse__created'] = '';
$data['warehouse__createdby'] = '';
		

		$this->load->view('warehouse_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['warehouse__name']) && ($_POST['warehouse__name'] == "" || $_POST['warehouse__name'] == null))
$error .= "<span class='error'>Name must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['warehouse__name']))
$data['name'] = $_POST['warehouse__name'];if (isset($_POST['warehouse__address']))
$data['address'] = $_POST['warehouse__address'];if (isset($_POST['warehouse__phone']))
$data['phone'] = $_POST['warehouse__phone'];if (isset($_POST['warehouse__fax']))
$data['fax'] = $_POST['warehouse__fax'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('warehouse', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$warehouse_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('warehouseadd','warehouse','aftersave', $warehouse_id);
			
		
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