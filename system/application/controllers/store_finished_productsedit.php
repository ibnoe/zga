<?php

class store_finished_productsedit extends Controller {

	function store_finished_productsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($store_finished_products_id=0)
	{
		
$q = $this->db->where('id', $store_finished_products_id);
$q = $this->db->get('morder');
if ($q->num_rows() > 0) {
$data = array();
$data['store_finished_products_id'] = $store_finished_products_id;
foreach ($q->result() as $r) {
$data['morder__orderid'] = $r->orderid;
$data['morder__date'] = $r->date;
$data['morder__notes'] = $r->notes;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['morder__from_id'] = $r->from_id;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['morder__to_id'] = $r->to_id;
$data['morder__orderid'] = $r->orderid;
$data['morder__date'] = $r->date;
$data['morder__notes'] = $r->notes;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['morder__from_id'] = $r->from_id;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['morder__to_id'] = $r->to_id;
$data['morder__'] = $r->;}
$this->load->view('store_finished_products_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['morder__orderid'])) {$this->db->where("id !=", $_POST['store_finished_products_id']);
$this->db->where('orderid', $_POST['morder__orderid']);
$q = $this->db->get('morder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

if (isset($_POST['morder__orderid'])) {$this->db->where("id !=", $_POST['store_finished_products_id']);
$this->db->where('orderid', $_POST['morder__orderid']);
$q = $this->db->get('morder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['morder__orderid']))
$data['orderid'] = $_POST['morder__orderid'];if (isset($_POST['morder__date']))
$data['date'] = $_POST['morder__date'];if (isset($_POST['morder__notes']))
$data['notes'] = $_POST['morder__notes'];if (isset($_POST['morder__from_id']))
$data['from_id'] = $_POST['morder__from_id'];if (isset($_POST['morder__to_id']))
$data['to_id'] = $_POST['morder__to_id'];if (isset($_POST['morder__orderid']))
$data['orderid'] = $_POST['morder__orderid'];if (isset($_POST['morder__date']))
$data['date'] = $_POST['morder__date'];if (isset($_POST['morder__notes']))
$data['notes'] = $_POST['morder__notes'];if (isset($_POST['morder__from_id']))
$data['from_id'] = $_POST['morder__from_id'];if (isset($_POST['morder__to_id']))
$data['to_id'] = $_POST['morder__to_id'];if (isset($_POST['morder__']))
$data[''] = $_POST['morder__'];
$this->db->where('id', $_POST['store_finished_products_id']);
$this->db->update('morder', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>