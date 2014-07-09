<?php

class insert_item_lineadd extends Controller {

	function insert_item_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['insertitem_id'] = $id;
$data['insertitemline__idstring'] = '';
$data['insertitemline__date'] = '';
$data['insertitemline__notes'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['insertitemline__warehouse_id'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['insertitemline__item_id'] = '';
$data['insertitemline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['insertitemline__uom_id'] = '';
$data['insertitemline__lastupdate'] = '';
$data['insertitemline__updatedby'] = '';
$data['insertitemline__created'] = '';
$data['insertitemline__createdby'] = '';
$insertitem = array();
$this->db->where('id', $id);
$q = $this->db->get('insertitem');
if ($q->num_rows() > 0)
$insertitem = $q->row_array();
$data['insertitemline__idstring'] = $insertitem['idstring'];
$data['insertitemline__date'] = $insertitem['date'];
$data['insertitemline__notes'] = $insertitem['notes'];
$data['insertitemline__lastupdate'] = $insertitem['lastupdate'];
$data['insertitemline__updatedby'] = $insertitem['updatedby'];
$data['insertitemline__created'] = $insertitem['created'];
$data['insertitemline__createdby'] = $insertitem['createdby'];
		

		$this->load->view('insert_item_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['insertitemline__warehouse_id']) || ($_POST['insertitemline__warehouse_id'] == "" || $_POST['insertitemline__warehouse_id'] == null  || $_POST['insertitemline__warehouse_id'] == null))
$error .= "<span class='error'>Location must not be empty"."</span><br>";

if (!isset($_POST['insertitemline__item_id']) || ($_POST['insertitemline__item_id'] == "" || $_POST['insertitemline__item_id'] == null  || $_POST['insertitemline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['insertitemline__quantity']) && ($_POST['insertitemline__quantity'] == "" || $_POST['insertitemline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['insertitemline__uom_id']) || ($_POST['insertitemline__uom_id'] == "" || $_POST['insertitemline__uom_id'] == null  || $_POST['insertitemline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['insertitem_id'] = $_POST['insertitem_id'];if (isset($_POST['insertitemline__idstring']))
$data['idstring'] = $_POST['insertitemline__idstring'];if (isset($_POST['insertitemline__date']))
$data['date'] = $_POST['insertitemline__date'];if (isset($_POST['insertitemline__notes']))
$data['notes'] = $_POST['insertitemline__notes'];if (isset($_POST['insertitemline__warehouse_id']))
$data['warehouse_id'] = $_POST['insertitemline__warehouse_id'];if (isset($_POST['insertitemline__item_id']))
$data['item_id'] = $_POST['insertitemline__item_id'];if (isset($_POST['insertitemline__quantity']))
$data['quantity'] = $_POST['insertitemline__quantity'];if (isset($_POST['insertitemline__uom_id']))
$data['uom_id'] = $_POST['insertitemline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('insertitemline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$insertitemline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('insert_item_lineadd','insertitemline','aftersave', $insertitemline_id);
			
		
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