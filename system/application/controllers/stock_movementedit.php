<?php

class stock_movementedit extends Controller {

	function stock_movementedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($stock_movement_id=0)
	{
		if ($stock_movement_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $stock_movement_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('moveaction');
if ($q->num_rows() > 0) {
$data = array();
$data['stock_movement_id'] = $stock_movement_id;
foreach ($q->result() as $r) {
$data['moveaction__date'] = $r->date;
$data['moveaction__orderid'] = $r->orderid;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveaction__from_warehouse_id'] = $r->from_warehouse_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['moveaction__to_warehouse_id'] = $r->to_warehouse_id;
$data['moveaction__lastupdate'] = $r->lastupdate;
$data['moveaction__updatedby'] = $r->updatedby;
$data['moveaction__created'] = $r->created;
$data['moveaction__createdby'] = $r->createdby;}
$this->load->view('stock_movement_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['moveaction__date']) && ($_POST['moveaction__date'] == "" || $_POST['moveaction__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['moveaction__orderid']) && ($_POST['moveaction__orderid'] == "" || $_POST['moveaction__orderid'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['moveaction__orderid'])) {$this->db->where("id !=", $_POST['stock_movement_id']);
$this->db->where('orderid', $_POST['moveaction__orderid']);
$q = $this->db->get('moveaction');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['moveaction__date']))
$this->db->set('date', "str_to_date('".$_POST['moveaction__date']."', '%d-%m-%Y')", false);if (isset($_POST['moveaction__orderid']))
$data['orderid'] = $_POST['moveaction__orderid'];if (isset($_POST['moveaction__from_warehouse_id']))
$data['from_warehouse_id'] = $_POST['moveaction__from_warehouse_id'];if (isset($_POST['moveaction__to_warehouse_id']))
$data['to_warehouse_id'] = $_POST['moveaction__to_warehouse_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['stock_movement_id']);
$this->db->update('moveaction', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('stock_movementedit','moveaction','afteredit', $_POST['stock_movement_id']);
			
			
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