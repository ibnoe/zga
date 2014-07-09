<?php

class penerimaan_item_for_serviceedit extends Controller {

	function penerimaan_item_for_serviceedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($penerimaan_item_for_service_id=0)
	{
		if ($penerimaan_item_for_service_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $penerimaan_item_for_service_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('insertitem');
if ($q->num_rows() > 0) {
$data = array();
$data['penerimaan_item_for_service_id'] = $penerimaan_item_for_service_id;
foreach ($q->result() as $r) {
$data['insertitem__idstring'] = $r->idstring;
$data['insertitem__date'] = $r->date;
$data['insertitem__notes'] = $r->notes;
$data['insertitem__lastupdate'] = $r->lastupdate;
$data['insertitem__updatedby'] = $r->updatedby;
$data['insertitem__created'] = $r->created;
$data['insertitem__createdby'] = $r->createdby;}
$this->load->view('penerimaan_item_for_service_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['insertitem__idstring']) && ($_POST['insertitem__idstring'] == "" || $_POST['insertitem__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['insertitem__idstring'])) {$this->db->where("id !=", $_POST['penerimaan_item_for_service_id']);
$this->db->where('idstring', $_POST['insertitem__idstring']);
$q = $this->db->get('insertitem');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['insertitem__date']) && ($_POST['insertitem__date'] == "" || $_POST['insertitem__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['insertitem__idstring']))
$data['idstring'] = $_POST['insertitem__idstring'];if (isset($_POST['insertitem__date']))
$this->db->set('date', "str_to_date('".$_POST['insertitem__date']."', '%d-%m-%Y')", false);if (isset($_POST['insertitem__notes']))
$data['notes'] = $_POST['insertitem__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['penerimaan_item_for_service_id']);
$this->db->update('insertitem', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('penerimaan_item_for_serviceedit','insertitem','afteredit', $_POST['penerimaan_item_for_service_id']);
			
			
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