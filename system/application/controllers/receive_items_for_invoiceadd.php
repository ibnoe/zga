<?php

class receive_items_for_invoiceadd extends Controller {

	function receive_items_for_invoiceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['receiveditem__date'] = '';
$data['receiveditem__orderid'] = '';$this->load->library('generallib');
$data['receiveditem__orderid'] = $this->generallib->genId('Receive Items For Invoice');
$data['receiveditem__suratjalanno'] = '';$this->load->library('generallib');
$data['receiveditem__suratjalanno'] = $this->generallib->genId('Receive Items For Invoice');
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['receiveditem__supplier_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['receiveditem__warehouse_id'] = '';
$data['receiveditem__lastupdate'] = '';
$data['receiveditem__updatedby'] = '';
$data['receiveditem__created'] = '';
$data['receiveditem__createdby'] = '';
		

		$this->load->view('receive_items_for_invoice_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['receiveditem__date']) && ($_POST['receiveditem__date'] == "" || $_POST['receiveditem__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['receiveditem__orderid']) && ($_POST['receiveditem__orderid'] == "" || $_POST['receiveditem__orderid'] == null))
$error .= "<span class='error'>Receive Item No must not be empty"."</span><br>";

if (isset($_POST['receiveditem__orderid'])) {
$this->db->where('orderid', $_POST['receiveditem__orderid']);
$q = $this->db->get('receiveditem');
if ($q->num_rows() > 0) $error .= "<span class='error'>Receive Item No must be unique"."</span><br>";}

if (isset($_POST['receiveditem__suratjalanno']) && ($_POST['receiveditem__suratjalanno'] == "" || $_POST['receiveditem__suratjalanno'] == null))
$error .= "<span class='error'>Surat Jalan No must not be empty"."</span><br>";

if (!isset($_POST['receiveditem__supplier_id']) || ($_POST['receiveditem__supplier_id'] == "" || $_POST['receiveditem__supplier_id'] == null  || $_POST['receiveditem__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['receiveditem__warehouse_id']) || ($_POST['receiveditem__warehouse_id'] == "" || $_POST['receiveditem__warehouse_id'] == null  || $_POST['receiveditem__warehouse_id'] == null))
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
$this->db->insert('receiveditem', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$receiveditem_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('receive_items_for_invoiceadd','receiveditem','aftersave', $receiveditem_id);
			
		
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