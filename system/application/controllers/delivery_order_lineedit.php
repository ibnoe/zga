<?php

class delivery_order_lineedit extends Controller {

	function delivery_order_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($delivery_order_line_id=0)
	{
		if ($delivery_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $delivery_order_line_id);
$this->db->select('*');
$q = $this->db->get('deliveryorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['delivery_order_line_id'] = $delivery_order_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['deliveryorderline__item_id'] = $r->item_id;
$data['deliveryorderline__quantitytosend'] = $r->quantitytosend;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['deliveryorderline__uom_id'] = $r->uom_id;
$data['deliveryorderline__salesorderline_id'] = $r->salesorderline_id;
$data['deliveryorderline__lastupdate'] = $r->lastupdate;
$data['deliveryorderline__updatedby'] = $r->updatedby;
$data['deliveryorderline__created'] = $r->created;
$data['deliveryorderline__createdby'] = $r->createdby;}
$this->load->view('delivery_order_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['deliveryorderline__item_id']) || ($_POST['deliveryorderline__item_id'] == "" || $_POST['deliveryorderline__item_id'] == null  || $_POST['deliveryorderline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['deliveryorderline__quantitytosend']) && ($_POST['deliveryorderline__quantitytosend'] == "" || $_POST['deliveryorderline__quantitytosend'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['deliveryorderline__uom_id']) || ($_POST['deliveryorderline__uom_id'] == "" || $_POST['deliveryorderline__uom_id'] == null  || $_POST['deliveryorderline__uom_id'] == 0))
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
$this->db->where('id', $_POST['delivery_order_line_id']);
$this->db->update('deliveryorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('delivery_order_lineedit','deliveryorderline','afteredit', $_POST['delivery_order_line_id']);
			
			
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