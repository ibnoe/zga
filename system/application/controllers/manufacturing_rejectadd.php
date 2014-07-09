<?php

class manufacturing_rejectadd extends Controller {

	function manufacturing_rejectadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['manufacturingreject__idstring'] = '';$this->load->library('generallib');
$data['manufacturingreject__idstring'] = $this->generallib->genId('Manufacturing Reject');
$data['manufacturingreject__date'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingreject__item_id'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingreject__warehouse_id'] = '';
$data['manufacturingreject__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingreject__uom_id'] = '';
$data['manufacturingreject__lastupdate'] = '';
$data['manufacturingreject__updatedby'] = '';
$data['manufacturingreject__created'] = '';
$data['manufacturingreject__createdby'] = '';
		

		$this->load->view('manufacturing_reject_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['manufacturingreject__idstring']) && ($_POST['manufacturingreject__idstring'] == "" || $_POST['manufacturingreject__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['manufacturingreject__idstring'])) {
$this->db->where('idstring', $_POST['manufacturingreject__idstring']);
$q = $this->db->get('manufacturingreject');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['manufacturingreject__date']) && ($_POST['manufacturingreject__date'] == "" || $_POST['manufacturingreject__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['manufacturingreject__item_id']) || ($_POST['manufacturingreject__item_id'] == "" || $_POST['manufacturingreject__item_id'] == null  || $_POST['manufacturingreject__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (!isset($_POST['manufacturingreject__warehouse_id']) || ($_POST['manufacturingreject__warehouse_id'] == "" || $_POST['manufacturingreject__warehouse_id'] == null  || $_POST['manufacturingreject__warehouse_id'] == null))
$error .= "<span class='error'>Goods Location must not be empty"."</span><br>";

if (isset($_POST['manufacturingreject__quantity']) && ($_POST['manufacturingreject__quantity'] == "" || $_POST['manufacturingreject__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['manufacturingreject__uom_id']) || ($_POST['manufacturingreject__uom_id'] == "" || $_POST['manufacturingreject__uom_id'] == null  || $_POST['manufacturingreject__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['manufacturingreject__idstring']))
$data['idstring'] = $_POST['manufacturingreject__idstring'];if (isset($_POST['manufacturingreject__date']))
$this->db->set('date', "str_to_date('".$_POST['manufacturingreject__date']."', '%d-%m-%Y')", false);if (isset($_POST['manufacturingreject__item_id']))
$data['item_id'] = $_POST['manufacturingreject__item_id'];if (isset($_POST['manufacturingreject__warehouse_id']))
$data['warehouse_id'] = $_POST['manufacturingreject__warehouse_id'];if (isset($_POST['manufacturingreject__quantity']))
$data['quantity'] = $_POST['manufacturingreject__quantity'];if (isset($_POST['manufacturingreject__uom_id']))
$data['uom_id'] = $_POST['manufacturingreject__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('manufacturingreject', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$manufacturingreject_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_rejectadd','manufacturingreject','aftersave', $manufacturingreject_id);
			
		
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