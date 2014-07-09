<?php

class rcn_lineadd extends Controller {

	function rcn_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['rcn_id'] = $id;
$data['rcnline__noiden'] = '';
$data['rcnline__quantity'] = '';
$data['rcnline__pos'] = '';
$data['rcnline__rd'] = '';
$data['rcnline__cd'] = '';
$data['rcnline__rl'] = '';
$data['rcnline__wl'] = '';
$data['rcnline__tl'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rcnline__compound_id'] = '';
$data['rcnline__accfitted'] = '';
$mesin_opt = array();
$mesin_opt[''] = 'None';
$q = $this->db->get('mesin');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['rcnline__mesin_id'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rcnline__core_id'] = '';
$data['rcnline__itemno'] = '';
$data['rcnline__lastupdate'] = '';
$data['rcnline__updatedby'] = '';
$data['rcnline__created'] = '';
$data['rcnline__createdby'] = '';
		

		$this->load->view('rcn_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['rcnline__quantity']) && ($_POST['rcnline__quantity'] == "" || $_POST['rcnline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['rcnline__compound_id']) || ($_POST['rcnline__compound_id'] == "" || $_POST['rcnline__compound_id'] == null  || $_POST['rcnline__compound_id'] == null))
$error .= "<span class='error'>Compound must not be empty"."</span><br>";

if (!isset($_POST['rcnline__core_id']) || ($_POST['rcnline__core_id'] == "" || $_POST['rcnline__core_id'] == null  || $_POST['rcnline__core_id'] == null))
$error .= "<span class='error'>Roller Type must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['rcn_id'] = $_POST['rcn_id'];if (isset($_POST['rcnline__noiden']))
$data['noiden'] = $_POST['rcnline__noiden'];if (isset($_POST['rcnline__quantity']))
$data['quantity'] = $_POST['rcnline__quantity'];if (isset($_POST['rcnline__pos']))
$data['pos'] = $_POST['rcnline__pos'];if (isset($_POST['rcnline__rd']))
$data['rd'] = $_POST['rcnline__rd'];if (isset($_POST['rcnline__cd']))
$data['cd'] = $_POST['rcnline__cd'];if (isset($_POST['rcnline__rl']))
$data['rl'] = $_POST['rcnline__rl'];if (isset($_POST['rcnline__wl']))
$data['wl'] = $_POST['rcnline__wl'];if (isset($_POST['rcnline__tl']))
$data['tl'] = $_POST['rcnline__tl'];if (isset($_POST['rcnline__compound_id']))
$data['compound_id'] = $_POST['rcnline__compound_id'];if (isset($_POST['rcnline__accfitted']))
$data['accfitted'] = $_POST['rcnline__accfitted'];
else $data['accfitted'] = false;if (isset($_POST['rcnline__mesin_id']))
$data['mesin_id'] = $_POST['rcnline__mesin_id'];if (isset($_POST['rcnline__core_id']))
$data['core_id'] = $_POST['rcnline__core_id'];if (isset($_POST['rcnline__itemno']))
$data['itemno'] = $_POST['rcnline__itemno'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('rcnline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$rcnline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('rcn_lineadd','rcnline','aftersave', $rcnline_id);
			
		
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