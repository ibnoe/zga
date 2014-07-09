<?php

class sent_customers_itemsadd extends Controller {

	function sent_customers_itemsadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['deliveryorderline__lastupdate'] = '';
$data['deliveryorderline__updatedby'] = '';
$data['deliveryorderline__created'] = '';
$data['deliveryorderline__createdby'] = '';
		

		$this->load->view('sent_customers_items_add_form', $data);
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
$this->db->insert('deliveryorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$deliveryorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sent_customers_itemsadd','deliveryorderline','aftersave', $deliveryorderline_id);
			
		
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