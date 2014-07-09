<?php

class purchase_return_order_line_optionsedit extends Controller {

	function purchase_return_order_line_optionsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_order_line_options_id=0)
	{
		if ($purchase_return_order_line_options_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_return_order_line_options_id);
$this->db->select('*');
$q = $this->db->get('purchasereturnorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_order_line_options_id'] = $purchase_return_order_line_options_id;
foreach ($q->result() as $r) {
$data['purchasereturnorderline__lastupdate'] = $r->lastupdate;
$data['purchasereturnorderline__created'] = $r->created;}
$this->load->view('purchase_return_order_line_options_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['created'] = date('Y-m-d H:i:s');
$this->db->where('id', $_POST['purchase_return_order_line_options_id']);
$this->db->update('purchasereturnorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_order_line_optionsedit','purchasereturnorderline','afteredit', $_POST['purchase_return_order_line_options_id']);
			
			
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