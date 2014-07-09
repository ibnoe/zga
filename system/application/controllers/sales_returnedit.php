<?php

class sales_returnedit extends Controller {

	function sales_returnedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_id=0)
	{
		
$q = $this->db->where('id', $sales_return_id);
$q = $this->db->get('sreturn');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_id'] = $sales_return_id;
foreach ($q->result() as $r) {
$data['sreturn__orderid'] = $r->orderid;
$data['sreturn__date'] = $r->date;
$sorder_opt = array();
$q = $this->db->get('sorder');
foreach ($q->result() as $row) { $sorder_opt[$row->id] = $row->orderid; }
$data['sorder_opt'] = $sorder_opt;
$data['sreturn__sorder_id'] = $r->sorder_id;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['sreturn__to_id'] = $r->to_id;
$data['sreturn__orderid'] = $r->orderid;
$data['sreturn__date'] = $r->date;
$sorder_opt = array();
$q = $this->db->get('sorder');
foreach ($q->result() as $row) { $sorder_opt[$row->id] = $row->orderid; }
$data['sorder_opt'] = $sorder_opt;
$data['sreturn__sorder_id'] = $r->sorder_id;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['sreturn__to_id'] = $r->to_id;
$data['sreturn__'] = $r->;}
$this->load->view('sales_return_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['sreturn__orderid'])) {$this->db->where("id !=", $_POST['sales_return_id']);
$this->db->where('orderid', $_POST['sreturn__orderid']);
$q = $this->db->get('sreturn');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

if (isset($_POST['sreturn__orderid'])) {$this->db->where("id !=", $_POST['sales_return_id']);
$this->db->where('orderid', $_POST['sreturn__orderid']);
$q = $this->db->get('sreturn');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['sreturn__orderid']))
$data['orderid'] = $_POST['sreturn__orderid'];if (isset($_POST['sreturn__date']))
$data['date'] = $_POST['sreturn__date'];if (isset($_POST['sreturn__sorder_id']))
$data['sorder_id'] = $_POST['sreturn__sorder_id'];if (isset($_POST['sreturn__to_id']))
$data['to_id'] = $_POST['sreturn__to_id'];if (isset($_POST['sreturn__orderid']))
$data['orderid'] = $_POST['sreturn__orderid'];if (isset($_POST['sreturn__date']))
$data['date'] = $_POST['sreturn__date'];if (isset($_POST['sreturn__sorder_id']))
$data['sorder_id'] = $_POST['sreturn__sorder_id'];if (isset($_POST['sreturn__to_id']))
$data['to_id'] = $_POST['sreturn__to_id'];if (isset($_POST['sreturn__']))
$data[''] = $_POST['sreturn__'];
$this->db->where('id', $_POST['sales_return_id']);
$this->db->update('sreturn', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>