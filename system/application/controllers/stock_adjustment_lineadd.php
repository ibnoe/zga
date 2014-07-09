<?php

class stock_adjustment_lineadd extends Controller {

	function stock_adjustment_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['stockadjustment_id'] = $id;
$data['stockadjustmentline__idstring'] = '';
$data['stockadjustmentline__date'] = '';
$data['stockadjustmentline__notes'] = '';
$data['stockadjustmentline__warehouse_id'] = '';
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['stockadjustmentline__coa_id'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['stockadjustmentline__item_id'] = '';
$data['stockadjustmentline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['stockadjustmentline__uom_id'] = '';
$data['stockadjustmentline__lastupdate'] = '';
$data['stockadjustmentline__updatedby'] = '';
$data['stockadjustmentline__created'] = '';
$data['stockadjustmentline__createdby'] = '';
$stockadjustment = array();
$this->db->where('id', $id);
$q = $this->db->get('stockadjustment');
if ($q->num_rows() > 0)
$stockadjustment = $q->row_array();
$data['stockadjustmentline__idstring'] = $stockadjustment['idstring'];
$data['stockadjustmentline__date'] = $stockadjustment['date'];
$data['stockadjustmentline__notes'] = $stockadjustment['notes'];
$data['stockadjustmentline__warehouse_id'] = $stockadjustment['warehouse_id'];
$data['stockadjustmentline__lastupdate'] = $stockadjustment['lastupdate'];
$data['stockadjustmentline__updatedby'] = $stockadjustment['updatedby'];
$data['stockadjustmentline__created'] = $stockadjustment['created'];
$data['stockadjustmentline__createdby'] = $stockadjustment['createdby'];
		

		$this->load->view('stock_adjustment_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['stockadjustmentline__coa_id']) || ($_POST['stockadjustmentline__coa_id'] == "" || $_POST['stockadjustmentline__coa_id'] == null  || $_POST['stockadjustmentline__coa_id'] == null))
$error .= "<span class='error'>Account must not be empty"."</span><br>";

if (!isset($_POST['stockadjustmentline__item_id']) || ($_POST['stockadjustmentline__item_id'] == "" || $_POST['stockadjustmentline__item_id'] == null  || $_POST['stockadjustmentline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['stockadjustmentline__quantity']) && ($_POST['stockadjustmentline__quantity'] == "" || $_POST['stockadjustmentline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['stockadjustmentline__uom_id']) || ($_POST['stockadjustmentline__uom_id'] == "" || $_POST['stockadjustmentline__uom_id'] == null  || $_POST['stockadjustmentline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['stockadjustment_id'] = $_POST['stockadjustment_id'];if (isset($_POST['stockadjustmentline__idstring']))
$data['idstring'] = $_POST['stockadjustmentline__idstring'];if (isset($_POST['stockadjustmentline__date']))
$data['date'] = $_POST['stockadjustmentline__date'];if (isset($_POST['stockadjustmentline__notes']))
$data['notes'] = $_POST['stockadjustmentline__notes'];if (isset($_POST['stockadjustmentline__warehouse_id']))
$data['warehouse_id'] = $_POST['stockadjustmentline__warehouse_id'];if (isset($_POST['stockadjustmentline__coa_id']))
$data['coa_id'] = $_POST['stockadjustmentline__coa_id'];if (isset($_POST['stockadjustmentline__item_id']))
$data['item_id'] = $_POST['stockadjustmentline__item_id'];if (isset($_POST['stockadjustmentline__quantity']))
$data['quantity'] = $_POST['stockadjustmentline__quantity'];if (isset($_POST['stockadjustmentline__uom_id']))
$data['uom_id'] = $_POST['stockadjustmentline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('stockadjustmentline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$stockadjustmentline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stock_adjustment_lineadd','stockadjustmentline','aftersave', $stockadjustmentline_id);
			
		
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