<?php

class roller_inspection_sheetedit extends Controller {

	function roller_inspection_sheetedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($roller_inspection_sheet_id=0)
	{
		if ($roller_inspection_sheet_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $roller_inspection_sheet_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('rollerinspectionsheet');
if ($q->num_rows() > 0) {
$data = array();
$data['roller_inspection_sheet_id'] = $roller_inspection_sheet_id;
foreach ($q->result() as $r) {
$data['rollerinspectionsheet__idstring'] = $r->idstring;
$data['rollerinspectionsheet__date'] = $r->date;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->idstring; }
$data['customer_opt'] = $customer_opt;
$data['rollerinspectionsheet__customer_id'] = $r->customer_id;
$mesin_opt = array();
$mesin_opt[''] = 'None';
$q = $this->db->get('mesin');
foreach ($q->result() as $row) { $mesin_opt[$row->id] = $row->typename; }
$data['mesin_opt'] = $mesin_opt;
$data['rollerinspectionsheet__mesin_id'] = $r->mesin_id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rollerinspectionsheet__roll_id'] = $r->roll_id;
$data['rollerinspectionsheet__orderno'] = $r->orderno;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rollerinspectionsheet__compound_id'] = $r->compound_id;
$data['rollerinspectionsheet__lastupdate'] = $r->lastupdate;
$data['rollerinspectionsheet__updatedby'] = $r->updatedby;
$data['rollerinspectionsheet__created'] = $r->created;
$data['rollerinspectionsheet__createdby'] = $r->createdby;}
$this->load->view('roller_inspection_sheet_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['rollerinspectionsheet__idstring']) && ($_POST['rollerinspectionsheet__idstring'] == "" || $_POST['rollerinspectionsheet__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['rollerinspectionsheet__idstring'])) {$this->db->where("id !=", $_POST['roller_inspection_sheet_id']);
$this->db->where('idstring', $_POST['rollerinspectionsheet__idstring']);
$q = $this->db->get('rollerinspectionsheet');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['rollerinspectionsheet__date']) && ($_POST['rollerinspectionsheet__date'] == "" || $_POST['rollerinspectionsheet__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['rollerinspectionsheet__customer_id']) || ($_POST['rollerinspectionsheet__customer_id'] == "" || $_POST['rollerinspectionsheet__customer_id'] == null  || $_POST['rollerinspectionsheet__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['rollerinspectionsheet__roll_id']) || ($_POST['rollerinspectionsheet__roll_id'] == "" || $_POST['rollerinspectionsheet__roll_id'] == null  || $_POST['rollerinspectionsheet__roll_id'] == 0))
$error .= "<span class='error'>Roll must not be empty"."</span><br>";

if (!isset($_POST['rollerinspectionsheet__compound_id']) || ($_POST['rollerinspectionsheet__compound_id'] == "" || $_POST['rollerinspectionsheet__compound_id'] == null  || $_POST['rollerinspectionsheet__compound_id'] == 0))
$error .= "<span class='error'>Compound must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rollerinspectionsheet__idstring']))
$data['idstring'] = $_POST['rollerinspectionsheet__idstring'];if (isset($_POST['rollerinspectionsheet__date']))
$this->db->set('date', "str_to_date('".$_POST['rollerinspectionsheet__date']."', '%d-%m-%Y')", false);if (isset($_POST['rollerinspectionsheet__customer_id']))
$data['customer_id'] = $_POST['rollerinspectionsheet__customer_id'];if (isset($_POST['rollerinspectionsheet__mesin_id']))
$data['mesin_id'] = $_POST['rollerinspectionsheet__mesin_id'];if (isset($_POST['rollerinspectionsheet__roll_id']))
$data['roll_id'] = $_POST['rollerinspectionsheet__roll_id'];if (isset($_POST['rollerinspectionsheet__orderno']))
$data['orderno'] = $_POST['rollerinspectionsheet__orderno'];if (isset($_POST['rollerinspectionsheet__compound_id']))
$data['compound_id'] = $_POST['rollerinspectionsheet__compound_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['roller_inspection_sheet_id']);
$this->db->update('rollerinspectionsheet', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('roller_inspection_sheetedit','rollerinspectionsheet','afteredit', $_POST['roller_inspection_sheet_id']);
			
			
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