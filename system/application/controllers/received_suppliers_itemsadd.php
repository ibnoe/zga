<?php

class received_suppliers_itemsadd extends Controller {

	function received_suppliers_itemsadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['receiveditemline__lastupdate'] = '';
$data['receiveditemline__updatedby'] = '';
$data['receiveditemline__created'] = '';
$data['receiveditemline__createdby'] = '';
		

		$this->load->view('received_suppliers_items_add_form', $data);
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
$this->db->insert('receiveditemline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$receiveditemline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('received_suppliers_itemsadd','receiveditemline','aftersave', $receiveditemline_id);
			
		
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