<?php

class journal_manualadd extends Controller {

	function journal_manualadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['journalmanual__reference'] = '';
$data['journalmanual__date'] = '';
$data['journalmanual__notes'] = '';
$data['journalmanual__lastupdate'] = '';
$data['journalmanual__updatedby'] = '';
$data['journalmanual__created'] = '';
$data['journalmanual__createdby'] = '';
		

		$this->load->view('journal_manual_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['journalmanual__reference']) && ($_POST['journalmanual__reference'] == "" || $_POST['journalmanual__reference'] == null))
$error .= "<span class='error'>Reference must not be empty"."</span><br>";

if (isset($_POST['journalmanual__reference'])) {
$this->db->where('reference', $_POST['journalmanual__reference']);
$q = $this->db->get('journalmanual');
if ($q->num_rows() > 0) $error .= "<span class='error'>Reference must be unique"."</span><br>";}

if (isset($_POST['journalmanual__date']) && ($_POST['journalmanual__date'] == "" || $_POST['journalmanual__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['journalmanual__reference']))
$data['reference'] = $_POST['journalmanual__reference'];if (isset($_POST['journalmanual__date']))
$this->db->set('date', "str_to_date('".$_POST['journalmanual__date']."', '%d-%m-%Y')", false);if (isset($_POST['journalmanual__notes']))
$data['notes'] = $_POST['journalmanual__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('journalmanual', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$journalmanual_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('journal_manualadd','journalmanual','aftersave', $journalmanual_id);
			
		
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