<?php

class purchase_returnedit extends Controller {

	function purchase_returnedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_id=0)
	{
		
$q = $this->db->where('id', $purchase_return_id);
$q = $this->db->get('preturn');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_id'] = $purchase_return_id;
foreach ($q->result() as $r) {
$data['preturn__orderid'] = $r->orderid;
$data['preturn__date'] = $r->date;
$porder_opt = array();
$q = $this->db->get('porder');
foreach ($q->result() as $row) { $porder_opt[$row->id] = $row->orderid; }
$data['porder_opt'] = $porder_opt;
$data['preturn__porder_id'] = $r->porder_id;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['preturn__to_id'] = $r->to_id;
$data['preturn__orderid'] = $r->orderid;
$data['preturn__date'] = $r->date;
$porder_opt = array();
$q = $this->db->get('porder');
foreach ($q->result() as $row) { $porder_opt[$row->id] = $row->orderid; }
$data['porder_opt'] = $porder_opt;
$data['preturn__porder_id'] = $r->porder_id;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['preturn__to_id'] = $r->to_id;
$data['preturn__'] = $r->;}
$this->load->view('purchase_return_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['preturn__orderid'])) {$this->db->where("id !=", $_POST['purchase_return_id']);
$this->db->where('orderid', $_POST['preturn__orderid']);
$q = $this->db->get('preturn');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

if (isset($_POST['preturn__orderid'])) {$this->db->where("id !=", $_POST['purchase_return_id']);
$this->db->where('orderid', $_POST['preturn__orderid']);
$q = $this->db->get('preturn');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['preturn__orderid']))
$data['orderid'] = $_POST['preturn__orderid'];if (isset($_POST['preturn__date']))
$data['date'] = $_POST['preturn__date'];if (isset($_POST['preturn__porder_id']))
$data['porder_id'] = $_POST['preturn__porder_id'];if (isset($_POST['preturn__to_id']))
$data['to_id'] = $_POST['preturn__to_id'];if (isset($_POST['preturn__orderid']))
$data['orderid'] = $_POST['preturn__orderid'];if (isset($_POST['preturn__date']))
$data['date'] = $_POST['preturn__date'];if (isset($_POST['preturn__porder_id']))
$data['porder_id'] = $_POST['preturn__porder_id'];if (isset($_POST['preturn__to_id']))
$data['to_id'] = $_POST['preturn__to_id'];if (isset($_POST['preturn__']))
$data[''] = $_POST['preturn__'];
$this->db->where('id', $_POST['purchase_return_id']);
$this->db->update('preturn', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>