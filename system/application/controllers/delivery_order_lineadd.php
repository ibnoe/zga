<?php

class delivery_order_lineadd extends Controller {

	function delivery_order_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['deliveryorderline__item_id'] = '';
$data['deliveryorderline__quantitytosend'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['deliveryorderline__uom_id'] = '';
$salesorderline_opt = array();
$salesorderline_opt[''] = 'None';
$q = $this->db->get('salesorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesorderline_opt[$row->id] = $row->orderid; }
$data['salesorderline_opt'] = $salesorderline_opt;
$data['deliveryorderline__salesorderline_id'] = '';
$data['deliveryorderline__lastupdate'] = '';
$data['deliveryorderline__updatedby'] = '';
$data['deliveryorderline__created'] = '';
$data['deliveryorderline__createdby'] = '';
		

		$this->load->view('delivery_order_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['deliveryorderline__item_id']) || ($_POST['deliveryorderline__item_id'] == "" || $_POST['deliveryorderline__item_id'] == null  || $_POST['deliveryorderline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['deliveryorderline__quantitytosend']) && ($_POST['deliveryorderline__quantitytosend'] == "" || $_POST['deliveryorderline__quantitytosend'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['deliveryorderline__uom_id']) || ($_POST['deliveryorderline__uom_id'] == "" || $_POST['deliveryorderline__uom_id'] == null  || $_POST['deliveryorderline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['deliveryorderline__item_id']))
$data['item_id'] = $_POST['deliveryorderline__item_id'];if (isset($_POST['deliveryorderline__quantitytosend']))
$data['quantitytosend'] = $_POST['deliveryorderline__quantitytosend'];if (isset($_POST['deliveryorderline__uom_id']))
$data['uom_id'] = $_POST['deliveryorderline__uom_id'];if (isset($_POST['deliveryorderline__salesorderline_id']))
$data['salesorderline_id'] = $_POST['deliveryorderline__salesorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('deliveryorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$deliveryorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('delivery_order_lineadd','deliveryorderline','aftersave', $deliveryorderline_id);
			
		
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