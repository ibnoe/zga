<?php

class manufacturing_rejectedit extends Controller {

	function manufacturing_rejectedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_reject_id=0)
	{
		if ($manufacturing_reject_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $manufacturing_reject_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('manufacturingreject');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_reject_id'] = $manufacturing_reject_id;
foreach ($q->result() as $r) {
$data['manufacturingreject__idstring'] = $r->idstring;
$data['manufacturingreject__date'] = $r->date;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['manufacturingreject__item_id'] = $r->item_id;
$warehouse_opt = array();
$warehouse_opt[''] = 'None';
$q = $this->db->get('warehouse');
foreach ($q->result() as $row) { $warehouse_opt[$row->id] = $row->name; }
$data['warehouse_opt'] = $warehouse_opt;
$data['manufacturingreject__warehouse_id'] = $r->warehouse_id;
$data['manufacturingreject__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['manufacturingreject__uom_id'] = $r->uom_id;
$data['manufacturingreject__lastupdate'] = $r->lastupdate;
$data['manufacturingreject__updatedby'] = $r->updatedby;
$data['manufacturingreject__created'] = $r->created;
$data['manufacturingreject__createdby'] = $r->createdby;}
$this->load->view('manufacturing_reject_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['manufacturingreject__idstring']) && ($_POST['manufacturingreject__idstring'] == "" || $_POST['manufacturingreject__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['manufacturingreject__idstring'])) {$this->db->where("id !=", $_POST['manufacturing_reject_id']);
$this->db->where('idstring', $_POST['manufacturingreject__idstring']);
$q = $this->db->get('manufacturingreject');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['manufacturingreject__date']) && ($_POST['manufacturingreject__date'] == "" || $_POST['manufacturingreject__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['manufacturingreject__item_id']) || ($_POST['manufacturingreject__item_id'] == "" || $_POST['manufacturingreject__item_id'] == null  || $_POST['manufacturingreject__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (!isset($_POST['manufacturingreject__warehouse_id']) || ($_POST['manufacturingreject__warehouse_id'] == "" || $_POST['manufacturingreject__warehouse_id'] == null  || $_POST['manufacturingreject__warehouse_id'] == 0))
$error .= "<span class='error'>Goods Location must not be empty"."</span><br>";

if (isset($_POST['manufacturingreject__quantity']) && ($_POST['manufacturingreject__quantity'] == "" || $_POST['manufacturingreject__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['manufacturingreject__uom_id']) || ($_POST['manufacturingreject__uom_id'] == "" || $_POST['manufacturingreject__uom_id'] == null  || $_POST['manufacturingreject__uom_id'] == 0))
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
$this->db->where('id', $_POST['manufacturing_reject_id']);
$this->db->update('manufacturingreject', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_rejectedit','manufacturingreject','afteredit', $_POST['manufacturing_reject_id']);
			
			
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