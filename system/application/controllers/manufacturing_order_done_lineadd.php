<?php

class manufacturing_order_done_lineadd extends Controller {

	function manufacturing_order_done_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['manufacturingorderdoneline__idstring'] = '';
$data['manufacturingorderdoneline__date'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingorderdoneline__item_id'] = '';
$data['manufacturingorderdoneline__quantitytoprocess'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingorderdoneline__uom_id'] = '';
$manufacturingorder_opt = array();
$manufacturingorder_opt[''] = 'None';
$q = $this->db->get('manufacturingorder');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $manufacturingorder_opt[$row->id] = $row->idstring; }
$data['manufacturingorder_opt'] = $manufacturingorder_opt;
$data['manufacturingorderdoneline__manufacturingorder_id'] = '';
$data['manufacturingorderdoneline__lastupdate'] = '';
$data['manufacturingorderdoneline__updatedby'] = '';
$data['manufacturingorderdoneline__created'] = '';
$data['manufacturingorderdoneline__createdby'] = '';
		

		$this->load->view('manufacturing_order_done_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['manufacturingorderdoneline__item_id']) || ($_POST['manufacturingorderdoneline__item_id'] == "" || $_POST['manufacturingorderdoneline__item_id'] == null  || $_POST['manufacturingorderdoneline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['manufacturingorderdoneline__quantitytoprocess']) && ($_POST['manufacturingorderdoneline__quantitytoprocess'] == "" || $_POST['manufacturingorderdoneline__quantitytoprocess'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorderdoneline__uom_id']) || ($_POST['manufacturingorderdoneline__uom_id'] == "" || $_POST['manufacturingorderdoneline__uom_id'] == null  || $_POST['manufacturingorderdoneline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['manufacturingorderdoneline__idstring']))
$data['idstring'] = $_POST['manufacturingorderdoneline__idstring'];if (isset($_POST['manufacturingorderdoneline__date']))
$data['date'] = $_POST['manufacturingorderdoneline__date'];if (isset($_POST['manufacturingorderdoneline__item_id']))
$data['item_id'] = $_POST['manufacturingorderdoneline__item_id'];if (isset($_POST['manufacturingorderdoneline__quantitytoprocess']))
$data['quantitytoprocess'] = $_POST['manufacturingorderdoneline__quantitytoprocess'];if (isset($_POST['manufacturingorderdoneline__uom_id']))
$data['uom_id'] = $_POST['manufacturingorderdoneline__uom_id'];if (isset($_POST['manufacturingorderdoneline__manufacturingorder_id']))
$data['manufacturingorder_id'] = $_POST['manufacturingorderdoneline__manufacturingorder_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('manufacturingorderdoneline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$manufacturingorderdoneline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_order_done_lineadd','manufacturingorderdoneline','aftersave', $manufacturingorderdoneline_id);
			
		
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