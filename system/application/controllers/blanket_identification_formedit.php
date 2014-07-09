<?php

class blanket_identification_formedit extends Controller {

	function blanket_identification_formedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($blanket_identification_form_id=0)
	{
		if ($blanket_identification_form_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $blanket_identification_form_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date', false);
$q = $this->db->get('bif');
if ($q->num_rows() > 0) {
$data = array();
$data['blanket_identification_form_id'] = $blanket_identification_form_id;
foreach ($q->result() as $r) {
$data['bif__idstring'] = $r->idstring;
$data['bif__date'] = $r->date;
$marketingofficer_opt = array();
$marketingofficer_opt[''] = 'None';
$q = $this->db->get('marketingofficer');
foreach ($q->result() as $row) { $marketingofficer_opt[$row->id] = $row->name; }
$data['marketingofficer_opt'] = $marketingofficer_opt;
$data['bif__marketingofficer_id'] = $r->marketingofficer_id;
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['bif__customer_id'] = $r->customer_id;
$data['bif__pressmodel'] = $r->pressmodel;
$data['bif__ac'] = $r->ac;
$data['bif__ar'] = $r->ar;
$data['bif__thickness'] = $r->thickness;
$data['bif__typebar1'] = $r->typebar1;
$data['bif__lengthbar1'] = $r->lengthbar1;
$data['bif__positionbar1'] = $r->positionbar1;
$data['bif__typebar2'] = $r->typebar2;
$data['bif__lengthbar2'] = $r->lengthbar2;
$data['bif__positionbar2'] = $r->positionbar2;
$data['bif__corner'] = $r->corner;
$data['bif__needs'] = $r->needs;
$data['bif__drawingfile'] = $r->drawingfile;
$data['bif__notes'] = $r->notes;
$data['bif__lastupdate'] = $r->lastupdate;
$data['bif__updatedby'] = $r->updatedby;
$data['bif__created'] = $r->created;
$data['bif__createdby'] = $r->createdby;}
$this->load->view('blanket_identification_form_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['bif__idstring']) && ($_POST['bif__idstring'] == "" || $_POST['bif__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['bif__idstring'])) {$this->db->where("id !=", $_POST['blanket_identification_form_id']);
$this->db->where('idstring', $_POST['bif__idstring']);
$q = $this->db->get('bif');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['bif__date']) && ($_POST['bif__date'] == "" || $_POST['bif__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['bif__customer_id']) || ($_POST['bif__customer_id'] == "" || $_POST['bif__customer_id'] == null  || $_POST['bif__customer_id'] == 0))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['bif__idstring']))
$data['idstring'] = $_POST['bif__idstring'];if (isset($_POST['bif__date']))
$this->db->set('date', "str_to_date('".$_POST['bif__date']."', '%d-%m-%Y')", false);if (isset($_POST['bif__marketingofficer_id']))
$data['marketingofficer_id'] = $_POST['bif__marketingofficer_id'];if (isset($_POST['bif__customer_id']))
$data['customer_id'] = $_POST['bif__customer_id'];if (isset($_POST['bif__pressmodel']))
$data['pressmodel'] = $_POST['bif__pressmodel'];if (isset($_POST['bif__ac']))
$data['ac'] = $_POST['bif__ac'];if (isset($_POST['bif__ar']))
$data['ar'] = $_POST['bif__ar'];if (isset($_POST['bif__thickness']))
$data['thickness'] = $_POST['bif__thickness'];if (isset($_POST['bif__typebar1']))
$data['typebar1'] = $_POST['bif__typebar1'];if (isset($_POST['bif__lengthbar1']))
$data['lengthbar1'] = $_POST['bif__lengthbar1'];if (isset($_POST['bif__positionbar1']))
$data['positionbar1'] = $_POST['bif__positionbar1'];if (isset($_POST['bif__typebar2']))
$data['typebar2'] = $_POST['bif__typebar2'];if (isset($_POST['bif__lengthbar2']))
$data['lengthbar2'] = $_POST['bif__lengthbar2'];if (isset($_POST['bif__positionbar2']))
$data['positionbar2'] = $_POST['bif__positionbar2'];if (isset($_POST['bif__corner']))
$data['corner'] = $_POST['bif__corner'];if (isset($_POST['bif__needs']))
$data['needs'] = $_POST['bif__needs'];
if (isset($_FILES['bif__drawingfile']) && $_FILES['bif__drawingfile']['tmp_name'] != null && $_FILES['bif__drawingfile']['tmp_name'] != ""){$filepath = 'upload//'.$_FILES['bif__drawingfile']['name'];move_uploaded_file($_FILES['bif__drawingfile']['tmp_name'], $filepath);$data['drawingfile'] = $_FILES['bif__drawingfile']['name'];}if (isset($_POST['bif__notes']))
$data['notes'] = $_POST['bif__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['blanket_identification_form_id']);
$this->db->update('bif', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('blanket_identification_formedit','bif','afteredit', $_POST['blanket_identification_form_id']);
			
			
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