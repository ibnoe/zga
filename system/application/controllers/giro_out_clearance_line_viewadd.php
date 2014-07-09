<?php

class giro_out_clearance_line_viewadd extends Controller {

	function giro_out_clearance_line_viewadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$giroout_opt = array();
$giroout_opt[''] = 'None';
$q = $this->db->get('giroout');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['girooutclearanceline__giroout_id'] = '';
$data['girooutclearanceline__lastupdate'] = '';
$data['girooutclearanceline__updatedby'] = '';
$data['girooutclearanceline__created'] = '';
$data['girooutclearanceline__createdby'] = '';
		

		$this->load->view('giro_out_clearance_line_view_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['girooutclearanceline__giroout_id']) || ($_POST['girooutclearanceline__giroout_id'] == "" || $_POST['girooutclearanceline__giroout_id'] == null  || $_POST['girooutclearanceline__giroout_id'] == null))
$error .= "<span class='error'>Giro Out must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['girooutclearanceline__giroout_id']))
$data['giroout_id'] = $_POST['girooutclearanceline__giroout_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('girooutclearanceline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$girooutclearanceline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_out_clearance_line_viewadd','girooutclearanceline','aftersave', $girooutclearanceline_id);
			
		
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