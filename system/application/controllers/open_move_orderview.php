<?php

class open_move_orderview extends Controller {

	function open_move_orderview()
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
	
		
$this->db->where('id', $open_move_order_id);
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
$this->load->view('open_move_order_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['lastupdate'] = $_POST['moveorderline__lastupdate'];
$data['updatedby'] = $_POST['moveorderline__updatedby'];
$data['created'] = $_POST['moveorderline__created'];
$data['createdby'] = $_POST['moveorderline__createdby'];
$this->db->where('id', $data['open_move_order_id']);
$this->db->update('moveorderline', $data);
			validationonserver();
			
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