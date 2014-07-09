<?php

class outgoing_customers_itemsadd extends Controller {

	function outgoing_customers_itemsadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesorderline__lastupdate'] = '';
$data['salesorderline__updatedby'] = '';
$data['salesorderline__created'] = '';
$data['salesorderline__createdby'] = '';
		

		$this->load->view('outgoing_customers_items_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('outgoing_customers_itemsadd','salesorderline','aftersave', $salesorderline_id);
			
		
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