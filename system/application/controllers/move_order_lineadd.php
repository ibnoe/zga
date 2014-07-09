<?php

class move_order_lineadd extends Controller {

	function move_order_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['moveorder_id'] = $id;
$data['moveorderline__orderid'] = '';
$data['moveorderline__date'] = '';
$data['moveorderline__from_warehouse_id'] = '';
$data['moveorderline__to_warehouse_id'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['moveorderline__item_id'] = '';
$data['moveorderline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['moveorderline__uom_id'] = '';
$data['moveorderline__lastupdate'] = '';
$data['moveorderline__updatedby'] = '';
$data['moveorderline__created'] = '';
$data['moveorderline__createdby'] = '';
$moveorder = array();
$this->db->where('id', $id);
$q = $this->db->get('moveorder');
if ($q->num_rows() > 0)
$moveorder = $q->row_array();
$data['moveorderline__orderid'] = $moveorder['orderid'];
$data['moveorderline__date'] = $moveorder['date'];
$data['moveorderline__from_warehouse_id'] = $moveorder['from_warehouse_id'];
$data['moveorderline__to_warehouse_id'] = $moveorder['to_warehouse_id'];
$data['moveorderline__lastupdate'] = $moveorder['lastupdate'];
$data['moveorderline__updatedby'] = $moveorder['updatedby'];
$data['moveorderline__created'] = $moveorder['created'];
$data['moveorderline__createdby'] = $moveorder['createdby'];
		

		$this->load->view('move_order_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['moveorderline__item_id']) || ($_POST['moveorderline__item_id'] == "" || $_POST['moveorderline__item_id'] == null  || $_POST['moveorderline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['moveorderline__quantity']) && ($_POST['moveorderline__quantity'] == "" || $_POST['moveorderline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['moveorderline__uom_id']) || ($_POST['moveorderline__uom_id'] == "" || $_POST['moveorderline__uom_id'] == null  || $_POST['moveorderline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['moveorder_id'] = $_POST['moveorder_id'];if (isset($_POST['moveorderline__orderid']))
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
$this->db->insert('moveorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$moveorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('move_order_lineadd','moveorderline','aftersave', $moveorderline_id);
			
		
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