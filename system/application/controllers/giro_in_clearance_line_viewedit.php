<?php

class giro_in_clearance_line_viewedit extends Controller {

	function giro_in_clearance_line_viewedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_in_clearance_line_view_id=0)
	{
		if ($giro_in_clearance_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $giro_in_clearance_line_view_id);
$this->db->select('*');
$q = $this->db->get('giroinclearanceline');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_in_clearance_line_view_id'] = $giro_in_clearance_line_view_id;
foreach ($q->result() as $r) {
$giroin_opt = array();
$giroin_opt[''] = 'None';
$q = $this->db->get('giroin');
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['giroinclearanceline__giroin_id'] = $r->giroin_id;
$data['giroinclearanceline__lastupdate'] = $r->lastupdate;
$data['giroinclearanceline__updatedby'] = $r->updatedby;
$data['giroinclearanceline__created'] = $r->created;
$data['giroinclearanceline__createdby'] = $r->createdby;}
$this->load->view('giro_in_clearance_line_view_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['giroinclearanceline__giroin_id']) || ($_POST['giroinclearanceline__giroin_id'] == "" || $_POST['giroinclearanceline__giroin_id'] == null  || $_POST['giroinclearanceline__giroin_id'] == 0))
$error .= "<span class='error'>Giro In must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['giroinclearanceline__giroin_id']))
$data['giroin_id'] = $_POST['giroinclearanceline__giroin_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['giro_in_clearance_line_view_id']);
$this->db->update('giroinclearanceline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_in_clearance_line_viewedit','giroinclearanceline','afteredit', $_POST['giro_in_clearance_line_view_id']);
			
			
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