<?php

class delivery_orderedit extends Controller {

	function delivery_orderedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($delivery_order_id=0)
	{
		if ($delivery_order_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $delivery_order_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$this->db->select('DATE_FORMAT(dodate, "%d-%m-%Y") as dodate', false);
$q = $this->db->get('deliveryorder');
if ($q->num_rows() > 0) {
$data = array();
$data['delivery_order_id'] = $delivery_order_id;
foreach ($q->result() as $r) {
$data['deliveryorder__date'] = $r->date;
$data['deliveryorder__orderid'] = $r->orderid;
$data['deliveryorder__donum'] = $r->donum;
$data['deliveryorder__dodate'] = $r->dodate;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['deliveryorder__customer_id'] = $r->customer_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['deliveryorder__warehouse_id'] = $r->warehouse_id;
$data['deliveryorder__deliveredby'] = $r->deliveredby;
$data['deliveryorder__vehicleno'] = $r->vehicleno;
$data['deliveryorder__notes'] = $r->notes;
$data['deliveryorder__lastupdate'] = $r->lastupdate;
$data['deliveryorder__updatedby'] = $r->updatedby;
$data['deliveryorder__created'] = $r->created;
$data['deliveryorder__createdby'] = $r->createdby;}
$this->load->view('delivery_order_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['deliveryorder__date']) && ($_POST['deliveryorder__date'] == "" || $_POST['deliveryorder__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['deliveryorder__orderid']) && ($_POST['deliveryorder__orderid'] == "" || $_POST['deliveryorder__orderid'] == null))
$error .= "<span class='error'>Delivery Order No must not be empty"."</span><br>";

if (isset($_POST['deliveryorder__orderid'])) {$this->db->where("id !=", $_POST['delivery_order_id']);
$this->db->where('orderid', $_POST['deliveryorder__orderid']);
$q = $this->db->get('deliveryorder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Delivery Order No must be unique"."</span><br>";}

if (isset($_POST['deliveryorder__dodate']) && ($_POST['deliveryorder__dodate'] == "" || $_POST['deliveryorder__dodate'] == null))
$error .= "<span class='error'>DO Date must not be empty"."</span><br>";

if (!isset($_POST['deliveryorder__customer_id']) || ($_POST['deliveryorder__customer_id'] == "" || $_POST['deliveryorder__customer_id'] == null  || $_POST['deliveryorder__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['deliveryorder__warehouse_id']) || ($_POST['deliveryorder__warehouse_id'] == "" || $_POST['deliveryorder__warehouse_id'] == null  || $_POST['deliveryorder__warehouse_id'] == 0))
$error .= "<span class='error'>Warehouse must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['deliveryorder__date']))
$this->db->set('date', "str_to_date('".$_POST['deliveryorder__date']."', '%d-%m-%Y')", false);if (isset($_POST['deliveryorder__orderid']))
$data['orderid'] = $_POST['deliveryorder__orderid'];if (isset($_POST['deliveryorder__donum']))
$data['donum'] = $_POST['deliveryorder__donum'];if (isset($_POST['deliveryorder__dodate']))
$this->db->set('dodate', "str_to_date('".$_POST['deliveryorder__dodate']."', '%d-%m-%Y')", false);if (isset($_POST['deliveryorder__customer_id']))
$data['customer_id'] = $_POST['deliveryorder__customer_id'];if (isset($_POST['deliveryorder__warehouse_id']))
$data['warehouse_id'] = $_POST['deliveryorder__warehouse_id'];if (isset($_POST['deliveryorder__deliveredby']))
$data['deliveredby'] = $_POST['deliveryorder__deliveredby'];if (isset($_POST['deliveryorder__vehicleno']))
$data['vehicleno'] = $_POST['deliveryorder__vehicleno'];if (isset($_POST['deliveryorder__notes']))
$data['notes'] = $_POST['deliveryorder__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['delivery_order_id']);
$this->db->update('deliveryorder', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('delivery_orderedit','deliveryorder','afteredit', $_POST['delivery_order_id']);
			
			
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