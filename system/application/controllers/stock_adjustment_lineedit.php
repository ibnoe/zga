<?php

class stock_adjustment_lineedit extends Controller {

	function stock_adjustment_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($stock_adjustment_line_id=0)
	{
		if ($stock_adjustment_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $stock_adjustment_line_id);
$this->db->select('*');
$q = $this->db->get('stockadjustmentline');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_adjustment_line_id'] = $stock_adjustment_line_id;
foreach ($q->result() as $r) {
$data['stockadjustmentline__idstring'] = $r->idstring;
$data['stockadjustmentline__date'] = $r->date;
$data['stockadjustmentline__notes'] = $r->notes;
$data['stockadjustmentline__warehouse_id'] = $r->warehouse_id;
$coa_opt = array();
$coa_opt[''] = 'None';
$q = $this->db->get('coa');
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['stockadjustmentline__coa_id'] = $r->coa_id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['stockadjustmentline__item_id'] = $r->item_id;
$data['stockadjustmentline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['stockadjustmentline__uom_id'] = $r->uom_id;
$data['stockadjustmentline__lastupdate'] = $r->lastupdate;
$data['stockadjustmentline__updatedby'] = $r->updatedby;
$data['stockadjustmentline__created'] = $r->created;
$data['stockadjustmentline__createdby'] = $r->createdby;}
$this->load->view('stock_adjustment_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['stockadjustmentline__coa_id']) || ($_POST['stockadjustmentline__coa_id'] == "" || $_POST['stockadjustmentline__coa_id'] == null  || $_POST['stockadjustmentline__coa_id'] == 0))
$error .= "<span class='error'>Account must not be empty"."</span><br>";

if (!isset($_POST['stockadjustmentline__item_id']) || ($_POST['stockadjustmentline__item_id'] == "" || $_POST['stockadjustmentline__item_id'] == null  || $_POST['stockadjustmentline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['stockadjustmentline__quantity']) && ($_POST['stockadjustmentline__quantity'] == "" || $_POST['stockadjustmentline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['stockadjustmentline__uom_id']) || ($_POST['stockadjustmentline__uom_id'] == "" || $_POST['stockadjustmentline__uom_id'] == null  || $_POST['stockadjustmentline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['stockadjustmentline__idstring']))
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
$this->db->where('id', $_POST['stock_adjustment_line_id']);
$this->db->update('stockadjustmentline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stock_adjustment_lineedit','stockadjustmentline','afteredit', $_POST['stock_adjustment_line_id']);
			
			
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