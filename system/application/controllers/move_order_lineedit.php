<?php

class move_order_lineedit extends Controller {

	function move_order_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($move_order_line_id=0)
	{
		if ($move_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $move_order_line_id);
$this->db->select('*');
$q = $this->db->get('moveorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['move_order_line_id'] = $move_order_line_id;
foreach ($q->result() as $r) {
$data['moveorderline__orderid'] = $r->orderid;
$data['moveorderline__date'] = $r->date;
$data['moveorderline__from_warehouse_id'] = $r->from_warehouse_id;
$data['moveorderline__to_warehouse_id'] = $r->to_warehouse_id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['moveorderline__item_id'] = $r->item_id;
$data['moveorderline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['moveorderline__uom_id'] = $r->uom_id;
$data['moveorderline__lastupdate'] = $r->lastupdate;
$data['moveorderline__updatedby'] = $r->updatedby;
$data['moveorderline__created'] = $r->created;
$data['moveorderline__createdby'] = $r->createdby;}
$this->load->view('move_order_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['moveorderline__item_id']) || ($_POST['moveorderline__item_id'] == "" || $_POST['moveorderline__item_id'] == null  || $_POST['moveorderline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['moveorderline__quantity']) && ($_POST['moveorderline__quantity'] == "" || $_POST['moveorderline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['moveorderline__uom_id']) || ($_POST['moveorderline__uom_id'] == "" || $_POST['moveorderline__uom_id'] == null  || $_POST['moveorderline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['moveorderline__orderid']))
$data['orderid'] = $_POST['moveorderline__orderid'];if (isset($_POST['moveorderline__date']))
$data['date'] = $_POST['moveorderline__date'];if (isset($_POST['moveorderline__from_warehouse_id']))
$data['from_warehouse_id'] = $_POST['moveorderline__from_warehouse_id'];if (isset($_POST['moveorderline__to_warehouse_id']))
$data['to_warehouse_id'] = $_POST['moveorderline__to_warehouse_id'];if (isset($_POST['moveorderline__item_id']))
$data['item_id'] = $_POST['moveorderline__item_id'];if (isset($_POST['moveorderline__quantity']))
$data['quantity'] = $_POST['moveorderline__quantity'];if (isset($_POST['moveorderline__uom_id']))
$data['uom_id'] = $_POST['moveorderline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['move_order_line_id']);
$this->db->update('moveorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('move_order_lineedit','moveorderline','afteredit', $_POST['move_order_line_id']);
			
			
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