<?php

class rcn_lineview extends Controller {

	function rcn_lineview()
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
	
		
$this->db->where('id', $rcn_line_id);
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
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rcnline__compound_id'] = $r->compound_id;
$data['rcnline__accfitted'] = $r->accfitted;
$mesin_opt = array();
$q = $this->db->get('mesin');
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['rcnline__mesin_id'] = $r->mesin_id;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rcnline__core_id'] = $r->core_id;
$data['rcnline__itemno'] = $r->itemno;
$data['rcnline__lastupdate'] = $r->lastupdate;
$data['rcnline__updatedby'] = $r->updatedby;
$data['rcnline__created'] = $r->created;
$data['rcnline__createdby'] = $r->createdby;}
$this->load->view('rcn_line_view_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		validation();
		
		if ($error == "")
		{
			
$data = array();
$data['noiden'] = $_POST['rcnline__noiden'];
$data['quantity'] = $_POST['rcnline__quantity'];
$data['pos'] = $_POST['rcnline__pos'];
$data['rd'] = $_POST['rcnline__rd'];
$data['cd'] = $_POST['rcnline__cd'];
$data['rl'] = $_POST['rcnline__rl'];
$data['wl'] = $_POST['rcnline__wl'];
$data['tl'] = $_POST['rcnline__tl'];
$data['compound_id'] = $_POST['rcnline__compound_id'];
$data['accfitted'] = $_POST['rcnline__accfitted'];
$data['mesin_id'] = $_POST['rcnline__mesin_id'];
$data['core_id'] = $_POST['rcnline__core_id'];
$data['itemno'] = $_POST['rcnline__itemno'];
$data['lastupdate'] = $_POST['rcnline__lastupdate'];
$data['updatedby'] = $_POST['rcnline__updatedby'];
$data['created'] = $_POST['rcnline__created'];
$data['createdby'] = $_POST['rcnline__createdby'];
$this->db->where('id', $data['rcn_line_id']);
$this->db->update('rcnline', $data);
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