<?php

class manufacturing_order_history_lineedit extends Controller {

	function manufacturing_order_history_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_order_history_line_id=0)
	{
		if ($manufacturing_order_history_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $manufacturing_order_history_line_id);
$this->db->select('*');
$q = $this->db->get('manufacturingorderdoneline');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_order_history_line_id'] = $manufacturing_order_history_line_id;
foreach ($q->result() as $r) {
$data['manufacturingorderdoneline__idstring'] = $r->idstring;
$data['manufacturingorderdoneline__date'] = $r->date;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingorderdoneline__item_id'] = $r->item_id;
$data['manufacturingorderdoneline__quantitytoprocess'] = $r->quantitytoprocess;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingorderdoneline__uom_id'] = $r->uom_id;
$data['manufacturingorderdoneline__manufacturingorder_id'] = $r->manufacturingorder_id;
$data['manufacturingorderdoneline__lastupdate'] = $r->lastupdate;
$data['manufacturingorderdoneline__updatedby'] = $r->updatedby;
$data['manufacturingorderdoneline__created'] = $r->created;
$data['manufacturingorderdoneline__createdby'] = $r->createdby;}
$this->load->view('manufacturing_order_history_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['manufacturingorderdoneline__item_id']) || ($_POST['manufacturingorderdoneline__item_id'] == "" || $_POST['manufacturingorderdoneline__item_id'] == null  || $_POST['manufacturingorderdoneline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['manufacturingorderdoneline__quantitytoprocess']) && ($_POST['manufacturingorderdoneline__quantitytoprocess'] == "" || $_POST['manufacturingorderdoneline__quantitytoprocess'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['manufacturingorderdoneline__uom_id']) || ($_POST['manufacturingorderdoneline__uom_id'] == "" || $_POST['manufacturingorderdoneline__uom_id'] == null  || $_POST['manufacturingorderdoneline__uom_id'] == 0))
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
$this->db->where('id', $_POST['manufacturing_order_history_line_id']);
$this->db->update('manufacturingorderdoneline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_order_history_lineedit','manufacturingorderdoneline','afteredit', $_POST['manufacturing_order_history_line_id']);
			
			
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