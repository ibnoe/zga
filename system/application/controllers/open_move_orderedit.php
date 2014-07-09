<?php

class open_move_orderedit extends Controller {

	function open_move_orderedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_move_order_id=0)
	{
		if ($open_move_order_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $open_move_order_id);
$this->db->select('*');
$q = $this->db->get('moveorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['open_move_order_id'] = $open_move_order_id;
foreach ($q->result() as $r) {
$data['moveorderline__lastupdate'] = $r->lastupdate;
$data['moveorderline__updatedby'] = $r->updatedby;
$data['moveorderline__created'] = $r->created;
$data['moveorderline__createdby'] = $r->createdby;}
$this->load->view('open_move_order_edit_form', $data);
}
		

		
		
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
$this->db->where('id', $_POST['open_move_order_id']);
$this->db->update('moveorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('open_move_orderedit','moveorderline','afteredit', $_POST['open_move_order_id']);
			
			
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