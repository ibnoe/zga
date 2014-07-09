<?php

class purchase_return_order_line_optionsadd extends Controller {

	function purchase_return_order_line_optionsadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasereturnorderline__lastupdate'] = '';
$data['purchasereturnorderline__created'] = '';
		

		$this->load->view('purchase_return_order_line_options_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['created'] = date('Y-m-d H:i:s');
$this->db->insert('purchasereturnorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturnorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_order_line_optionsadd','purchasereturnorderline','aftersave', $purchasereturnorderline_id);
			
		
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