<?php

class incoming_suppliers_itemsadd extends Controller {

	function incoming_suppliers_itemsadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchaseorderline__lastupdate'] = '';
$data['purchaseorderline__updatedby'] = '';
$data['purchaseorderline__created'] = '';
$data['purchaseorderline__createdby'] = '';
		

		$this->load->view('incoming_suppliers_items_add_form', $data);
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
$this->db->insert('purchaseorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchaseorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('incoming_suppliers_itemsadd','purchaseorderline','aftersave', $purchaseorderline_id);
			
		
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