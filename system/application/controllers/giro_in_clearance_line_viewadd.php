<?php

class giro_in_clearance_line_viewadd extends Controller {

	function giro_in_clearance_line_viewadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$giroin_opt = array();
$giroin_opt[''] = 'None';
$q = $this->db->get('giroin');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['giroinclearanceline__giroin_id'] = '';
$data['giroinclearanceline__lastupdate'] = '';
$data['giroinclearanceline__updatedby'] = '';
$data['giroinclearanceline__created'] = '';
$data['giroinclearanceline__createdby'] = '';
		

		$this->load->view('giro_in_clearance_line_view_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['giroinclearanceline__giroin_id']) || ($_POST['giroinclearanceline__giroin_id'] == "" || $_POST['giroinclearanceline__giroin_id'] == null  || $_POST['giroinclearanceline__giroin_id'] == null))
$error .= "<span class='error'>Giro In must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['giroinclearanceline__giroin_id']))
$data['giroin_id'] = $_POST['giroinclearanceline__giroin_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('giroinclearanceline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$giroinclearanceline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_in_clearance_line_viewadd','giroinclearanceline','aftersave', $giroinclearanceline_id);
			
		
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