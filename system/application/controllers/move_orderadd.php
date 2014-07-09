<?php

class move_orderadd extends Controller {

	function move_orderadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['moveorder__orderid'] = '';$this->load->library('generallib');
$data['moveorder__orderid'] = $this->generallib->genId('Move Order');
$data['moveorder__date'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveorder__from_warehouse_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveorder__to_warehouse_id'] = '';
$data['moveorder__notes'] = '';
$data['moveorder__lastupdate'] = '';
$data['moveorder__updatedby'] = '';
$data['moveorder__created'] = '';
$data['moveorder__createdby'] = '';
		

		$this->load->view('move_order_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['moveorder__orderid']) && ($_POST['moveorder__orderid'] == "" || $_POST['moveorder__orderid'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['moveorder__orderid'])) {
$this->db->where('orderid', $_POST['moveorder__orderid']);
$q = $this->db->get('moveorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['moveorder__date']) && ($_POST['moveorder__date'] == "" || $_POST['moveorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['moveorder__from_warehouse_id']) || ($_POST['moveorder__from_warehouse_id'] == "" || $_POST['moveorder__from_warehouse_id'] == null  || $_POST['moveorder__from_warehouse_id'] == null))
$error .= "<span class='error'>From Location must not be empty"."</span><br>";

if (!isset($_POST['moveorder__to_warehouse_id']) || ($_POST['moveorder__to_warehouse_id'] == "" || $_POST['moveorder__to_warehouse_id'] == null  || $_POST['moveorder__to_warehouse_id'] == null))
$error .= "<span class='error'>To Location must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['moveorder__orderid']))
$data['orderid'] = $_POST['moveorder__orderid'];if (isset($_POST['moveorder__date']))
$this->db->set('date', "str_to_date('".$_POST['moveorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['moveorder__from_warehouse_id']))
$data['from_warehouse_id'] = $_POST['moveorder__from_warehouse_id'];if (isset($_POST['moveorder__to_warehouse_id']))
$data['to_warehouse_id'] = $_POST['moveorder__to_warehouse_id'];if (isset($_POST['moveorder__notes']))
$data['notes'] = $_POST['moveorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('moveorder', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$moveorder_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('move_orderadd','moveorder','aftersave', $moveorder_id);
			
		
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