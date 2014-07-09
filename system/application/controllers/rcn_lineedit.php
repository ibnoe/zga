<?php

class rcn_lineedit extends Controller {

	function rcn_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($rcn_line_id=0)
	{
		if ($rcn_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $rcn_line_id);
$this->db->select('*');
$q = $this->db->get('rcnline');
if ($q->num_rows() > 0) {
$data = array();
$data['rcn_line_id'] = $rcn_line_id;
foreach ($q->result() as $r) {
$data['rcnline__noiden'] = $r->noiden;
$data['rcnline__quantity'] = $r->quantity;
$data['rcnline__pos'] = $r->pos;
$data['rcnline__rd'] = $r->rd;
$data['rcnline__cd'] = $r->cd;
$data['rcnline__rl'] = $r->rl;
$data['rcnline__wl'] = $r->wl;
$data['rcnline__tl'] = $r->tl;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rcnline__compound_id'] = $r->compound_id;
$data['rcnline__accfitted'] = $r->accfitted;
$mesin_opt = array();
$mesin_opt[''] = 'None';
$q = $this->db->get('mesin');
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['rcnline__mesin_id'] = $r->mesin_id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rcnline__core_id'] = $r->core_id;
$data['rcnline__itemno'] = $r->itemno;
$data['rcnline__lastupdate'] = $r->lastupdate;
$data['rcnline__updatedby'] = $r->updatedby;
$data['rcnline__created'] = $r->created;
$data['rcnline__createdby'] = $r->createdby;}
$this->load->view('rcn_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['rcnline__quantity']) && ($_POST['rcnline__quantity'] == "" || $_POST['rcnline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['rcnline__compound_id']) || ($_POST['rcnline__compound_id'] == "" || $_POST['rcnline__compound_id'] == null  || $_POST['rcnline__compound_id'] == 0))
$error .= "<span class='error'>Compound must not be empty"."</span><br>";

if (!isset($_POST['rcnline__core_id']) || ($_POST['rcnline__core_id'] == "" || $_POST['rcnline__core_id'] == null  || $_POST['rcnline__core_id'] == 0))
$error .= "<span class='error'>Roller Type must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rcnline__noiden']))
$data['noiden'] = $_POST['rcnline__noiden'];if (isset($_POST['rcnline__quantity']))
$data['quantity'] = $_POST['rcnline__quantity'];if (isset($_POST['rcnline__pos']))
$data['pos'] = $_POST['rcnline__pos'];if (isset($_POST['rcnline__rd']))
$data['rd'] = $_POST['rcnline__rd'];if (isset($_POST['rcnline__cd']))
$data['cd'] = $_POST['rcnline__cd'];if (isset($_POST['rcnline__rl']))
$data['rl'] = $_POST['rcnline__rl'];if (isset($_POST['rcnline__wl']))
$data['wl'] = $_POST['rcnline__wl'];if (isset($_POST['rcnline__tl']))
$data['tl'] = $_POST['rcnline__tl'];if (isset($_POST['rcnline__compound_id']))
$data['compound_id'] = $_POST['rcnline__compound_id'];
if (isset($_POST['rcnline__accfitted']))
$data['accfitted'] = 1;
else
$data['accfitted'] = 0;if (isset($_POST['rcnline__mesin_id']))
$data['mesin_id'] = $_POST['rcnline__mesin_id'];if (isset($_POST['rcnline__core_id']))
$data['core_id'] = $_POST['rcnline__core_id'];if (isset($_POST['rcnline__itemno']))
$data['itemno'] = $_POST['rcnline__itemno'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['rcn_line_id']);
$this->db->update('rcnline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('rcn_lineedit','rcnline','afteredit', $_POST['rcn_line_id']);
			
			
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