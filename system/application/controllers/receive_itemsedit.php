<?php

class receive_itemsedit extends Controller {

	function receive_itemsedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($receive_items_id=0)
	{
		if ($receive_items_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $receive_items_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('receiveditem');
if ($q->num_rows() > 0) {
$data = array();
$data['receive_items_id'] = $receive_items_id;
foreach ($q->result() as $r) {
$data['receiveditem__date'] = $r->date;
$data['receiveditem__orderid'] = $r->orderid;
$data['receiveditem__suratjalanno'] = $r->suratjalanno;
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['receiveditem__supplier_id'] = $r->supplier_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['receiveditem__warehouse_id'] = $r->warehouse_id;
$data['receiveditem__lastupdate'] = $r->lastupdate;
$data['receiveditem__updatedby'] = $r->updatedby;
$data['receiveditem__created'] = $r->created;
$data['receiveditem__createdby'] = $r->createdby;}
$this->load->view('receive_items_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['receiveditem__date']) && ($_POST['receiveditem__date'] == "" || $_POST['receiveditem__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['receiveditem__orderid']) && ($_POST['receiveditem__orderid'] == "" || $_POST['receiveditem__orderid'] == null))
$error .= "<span class='error'>Receive Item No must not be empty"."</span><br>";

if (isset($_POST['receiveditem__orderid'])) {$this->db->where("id !=", $_POST['receive_items_id']);
$this->db->where('orderid', $_POST['receiveditem__orderid']);
$q = $this->db->get('receiveditem');
if ($q->num_rows() > 0) $error .= "<span class='error'>Receive Item No must be unique"."</span><br>";}

if (isset($_POST['receiveditem__suratjalanno']) && ($_POST['receiveditem__suratjalanno'] == "" || $_POST['receiveditem__suratjalanno'] == null))
$error .= "<span class='error'>Surat Jalan No must not be empty"."</span><br>";

if (!isset($_POST['receiveditem__supplier_id']) || ($_POST['receiveditem__supplier_id'] == "" || $_POST['receiveditem__supplier_id'] == null  || $_POST['receiveditem__supplier_id'] == 0))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['receiveditem__warehouse_id']) || ($_POST['receiveditem__warehouse_id'] == "" || $_POST['receiveditem__warehouse_id'] == null  || $_POST['receiveditem__warehouse_id'] == 0))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['receiveditem__date']))
$this->db->set('date', "str_to_date('".$_POST['receiveditem__date']."', '%d-%m-%Y')", false);if (isset($_POST['receiveditem__orderid']))
$data['orderid'] = $_POST['receiveditem__orderid'];if (isset($_POST['receiveditem__suratjalanno']))
$data['suratjalanno'] = $_POST['receiveditem__suratjalanno'];if (isset($_POST['receiveditem__supplier_id']))
$data['supplier_id'] = $_POST['receiveditem__supplier_id'];if (isset($_POST['receiveditem__warehouse_id']))
$data['warehouse_id'] = $_POST['receiveditem__warehouse_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['receive_items_id']);
$this->db->update('receiveditem', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('receive_itemsedit','receiveditem','afteredit', $_POST['receive_items_id']);
			
			
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