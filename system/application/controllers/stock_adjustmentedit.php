<?php

class stock_adjustmentedit extends Controller {

	function stock_adjustmentedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($stock_adjustment_id=0)
	{
		if ($stock_adjustment_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $stock_adjustment_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('stockadjustment');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_adjustment_id'] = $stock_adjustment_id;
foreach ($q->result() as $r) {
$data['stockadjustment__idstring'] = $r->idstring;
$data['stockadjustment__date'] = $r->date;
$data['stockadjustment__notes'] = $r->notes;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['stockadjustment__warehouse_id'] = $r->warehouse_id;
$data['stockadjustment__lastupdate'] = $r->lastupdate;
$data['stockadjustment__updatedby'] = $r->updatedby;
$data['stockadjustment__created'] = $r->created;
$data['stockadjustment__createdby'] = $r->createdby;}
$this->load->view('stock_adjustment_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['stockadjustment__idstring']) && ($_POST['stockadjustment__idstring'] == "" || $_POST['stockadjustment__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['stockadjustment__idstring'])) {$this->db->where("id !=", $_POST['stock_adjustment_id']);
$this->db->where('idstring', $_POST['stockadjustment__idstring']);
$q = $this->db->get('stockadjustment');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['stockadjustment__date']) && ($_POST['stockadjustment__date'] == "" || $_POST['stockadjustment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['stockadjustment__warehouse_id']) || ($_POST['stockadjustment__warehouse_id'] == "" || $_POST['stockadjustment__warehouse_id'] == null  || $_POST['stockadjustment__warehouse_id'] == 0))
$error .= "<span class='error'>Location must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['stockadjustment__idstring']))
$data['idstring'] = $_POST['stockadjustment__idstring'];if (isset($_POST['stockadjustment__date']))
$this->db->set('date', "str_to_date('".$_POST['stockadjustment__date']."', '%d-%m-%Y')", false);if (isset($_POST['stockadjustment__notes']))
$data['notes'] = $_POST['stockadjustment__notes'];if (isset($_POST['stockadjustment__warehouse_id']))
$data['warehouse_id'] = $_POST['stockadjustment__warehouse_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['stock_adjustment_id']);
$this->db->update('stockadjustment', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stock_adjustmentedit','stockadjustment','afteredit', $_POST['stock_adjustment_id']);
			
			
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