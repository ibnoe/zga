<?php

class manufacturing_order_historyedit extends Controller {

	function manufacturing_order_historyedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($manufacturing_order_history_id=0)
	{
		if ($manufacturing_order_history_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $manufacturing_order_history_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('manufacturingorderdone');
if ($q->num_rows() > 0) {
$data = array();
$data['manufacturing_order_history_id'] = $manufacturing_order_history_id;
foreach ($q->result() as $r) {
$data['manufacturingorderdone__idstring'] = $r->idstring;
$data['manufacturingorderdone__date'] = $r->date;
$data['manufacturingorderdone__notes'] = $r->notes;
$data['manufacturingorderdone__lastupdate'] = $r->lastupdate;
$data['manufacturingorderdone__updatedby'] = $r->updatedby;
$data['manufacturingorderdone__created'] = $r->created;
$data['manufacturingorderdone__createdby'] = $r->createdby;}
$this->load->view('manufacturing_order_history_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['manufacturingorderdone__idstring']) && ($_POST['manufacturingorderdone__idstring'] == "" || $_POST['manufacturingorderdone__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['manufacturingorderdone__idstring'])) {$this->db->where("id !=", $_POST['manufacturing_order_history_id']);
$this->db->where('idstring', $_POST['manufacturingorderdone__idstring']);
$q = $this->db->get('manufacturingorderdone');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['manufacturingorderdone__date']) && ($_POST['manufacturingorderdone__date'] == "" || $_POST['manufacturingorderdone__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['manufacturingorderdone__idstring']))
$data['idstring'] = $_POST['manufacturingorderdone__idstring'];if (isset($_POST['manufacturingorderdone__date']))
$this->db->set('date', "str_to_date('".$_POST['manufacturingorderdone__date']."', '%d-%m-%Y')", false);if (isset($_POST['manufacturingorderdone__notes']))
$data['notes'] = $_POST['manufacturingorderdone__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['manufacturing_order_history_id']);
$this->db->update('manufacturingorderdone', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_order_historyedit','manufacturingorderdone','afteredit', $_POST['manufacturing_order_history_id']);
			
			
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