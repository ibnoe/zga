<?php

class stock_movement_line_viewadd extends Controller {

	function stock_movement_line_viewadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['moveaction_id'] = $id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['moveactionline__item_id'] = '';
$data['moveactionline__quantitytomove'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['moveactionline__uom_id'] = '';
$moveorderline_opt = array();
$moveorderline_opt[''] = 'None';
$q = $this->db->get('moveorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $moveorderline_opt[$row->id] = $row->orderid; }
$data['moveorderline_opt'] = $moveorderline_opt;
$data['moveactionline__moveorderline_id'] = '';
$data['moveactionline__lastupdate'] = '';
$data['moveactionline__updatedby'] = '';
$data['moveactionline__created'] = '';
$data['moveactionline__createdby'] = '';
		

		$this->load->view('stock_movement_line_view_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['moveactionline__item_id']) || ($_POST['moveactionline__item_id'] == "" || $_POST['moveactionline__item_id'] == null  || $_POST['moveactionline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['moveactionline__quantitytomove']) && ($_POST['moveactionline__quantitytomove'] == "" || $_POST['moveactionline__quantitytomove'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['moveactionline__uom_id']) || ($_POST['moveactionline__uom_id'] == "" || $_POST['moveactionline__uom_id'] == null  || $_POST['moveactionline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['moveaction_id'] = $_POST['moveaction_id'];if (isset($_POST['moveactionline__item_id']))
$data['item_id'] = $_POST['moveactionline__item_id'];if (isset($_POST['moveactionline__quantitytomove']))
$data['quantitytomove'] = $_POST['moveactionline__quantitytomove'];if (isset($_POST['moveactionline__uom_id']))
$data['uom_id'] = $_POST['moveactionline__uom_id'];if (isset($_POST['moveactionline__moveorderline_id']))
$data['moveorderline_id'] = $_POST['moveactionline__moveorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('moveactionline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$moveactionline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stock_movement_line_viewadd','moveactionline','aftersave', $moveactionline_id);
			
		
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