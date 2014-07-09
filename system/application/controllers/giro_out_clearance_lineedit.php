<?php

class giro_out_clearance_lineedit extends Controller {

	function giro_out_clearance_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($giro_out_clearance_line_id=0)
	{
		if ($giro_out_clearance_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $giro_out_clearance_line_id);
$this->db->select('*');
$q = $this->db->get('girooutclearanceline');
if ($q->num_rows() > 0) {
$data = array();
$data['giro_out_clearance_line_id'] = $giro_out_clearance_line_id;
foreach ($q->result() as $r) {
$giroout_opt = array();
$giroout_opt[''] = 'None';
$q = $this->db->get('giroout');
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['girooutclearanceline__giroout_id'] = $r->giroout_id;
$data['girooutclearanceline__lastupdate'] = $r->lastupdate;
$data['girooutclearanceline__updatedby'] = $r->updatedby;
$data['girooutclearanceline__created'] = $r->created;
$data['girooutclearanceline__createdby'] = $r->createdby;}
$this->load->view('giro_out_clearance_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['girooutclearanceline__giroout_id']) || ($_POST['girooutclearanceline__giroout_id'] == "" || $_POST['girooutclearanceline__giroout_id'] == null  || $_POST['girooutclearanceline__giroout_id'] == 0))
$error .= "<span class='error'>Giro Out must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['girooutclearanceline__giroout_id']))
$data['giroout_id'] = $_POST['girooutclearanceline__giroout_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['giro_out_clearance_line_id']);
$this->db->update('girooutclearanceline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_out_clearance_lineedit','girooutclearanceline','afteredit', $_POST['giro_out_clearance_line_id']);
			
			
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