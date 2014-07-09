<?php

class stock_adjustmentadd extends Controller {

	function stock_adjustmentadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['stockadjustment__idstring'] = '';$this->load->library('generallib');
$data['stockadjustment__idstring'] = $this->generallib->genId('Stock Adjustment');
$data['stockadjustment__date'] = '';
$data['stockadjustment__notes'] = '';
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['stockadjustment__warehouse_id'] = '';
$data['stockadjustment__lastupdate'] = '';
$data['stockadjustment__updatedby'] = '';
$data['stockadjustment__created'] = '';
$data['stockadjustment__createdby'] = '';
		

		$this->load->view('stock_adjustment_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['stockadjustment__idstring']) && ($_POST['stockadjustment__idstring'] == "" || $_POST['stockadjustment__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['stockadjustment__idstring'])) {
$this->db->where('idstring', $_POST['stockadjustment__idstring']);
$q = $this->db->get('stockadjustment');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['stockadjustment__date']) && ($_POST['stockadjustment__date'] == "" || $_POST['stockadjustment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['stockadjustment__warehouse_id']) || ($_POST['stockadjustment__warehouse_id'] == "" || $_POST['stockadjustment__warehouse_id'] == null  || $_POST['stockadjustment__warehouse_id'] == null))
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
$this->db->insert('stockadjustment', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$stockadjustment_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stock_adjustmentadd','stockadjustment','aftersave', $stockadjustment_id);
			
		
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