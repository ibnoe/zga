<?php

class roll_process_updateadd extends Controller {

	function roll_process_updateadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['rollprocessupdate__idstring'] = '';$this->load->library('generallib');
$data['rollprocessupdate__idstring'] = $this->generallib->genId('Roll Process Update');
$data['rollprocessupdate__noorderandcustomer'] = '';$this->load->library('generallib');
$data['rollprocessupdate__noorderandcustomer'] = $this->generallib->genId('Roll Process Update');
$data['rollprocessupdate__date'] = '';
$data['rollprocessupdate__qty1'] = '';
$data['rollprocessupdate__machinetyperoll'] = '';
$data['rollprocessupdate__compound'] = '';
$data['rollprocessupdate__rd'] = '';
$data['rollprocessupdate__wl'] = '';
$data['rollprocessupdate__tl'] = '';
$data['rollprocessupdate__qty2'] = '';
$data['rollprocessupdate__shipping'] = '';
$data['rollprocessupdate__wrapping'] = '';
$data['rollprocessupdate__vulcanizing'] = '';
$data['rollprocessupdate__faceoff'] = '';
$data['rollprocessupdate__grinding'] = '';
$data['rollprocessupdate__polishing'] = '';
$data['rollprocessupdate__maxdate'] = '';
$data['rollprocessupdate__deadlinedate'] = '';
$data['rollprocessupdate__notes'] = '';
$data['rollprocessupdate__lastupdate'] = '';
$data['rollprocessupdate__updatedby'] = '';
$data['rollprocessupdate__created'] = '';
$data['rollprocessupdate__createdby'] = '';
		

		$this->load->view('roll_process_update_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['rollprocessupdate__idstring']) && ($_POST['rollprocessupdate__idstring'] == "" || $_POST['rollprocessupdate__idstring'] == null))
$error .= "<span class='error'>No must not be empty"."</span><br>";

if (isset($_POST['rollprocessupdate__idstring'])) {
$this->db->where('idstring', $_POST['rollprocessupdate__idstring']);
$q = $this->db->get('rollprocessupdate');
if ($q->num_rows() > 0) $error .= "<span class='error'>No must be unique"."</span><br>";}

if (isset($_POST['rollprocessupdate__noorderandcustomer']) && ($_POST['rollprocessupdate__noorderandcustomer'] == "" || $_POST['rollprocessupdate__noorderandcustomer'] == null))
$error .= "<span class='error'>No Order And Customer must not be empty"."</span><br>";

if (isset($_POST['rollprocessupdate__noorderandcustomer'])) {
$this->db->where('noorderandcustomer', $_POST['rollprocessupdate__noorderandcustomer']);
$q = $this->db->get('rollprocessupdate');
if ($q->num_rows() > 0) $error .= "<span class='error'>No Order And Customer must be unique"."</span><br>";}

if (isset($_POST['rollprocessupdate__date']) && ($_POST['rollprocessupdate__date'] == "" || $_POST['rollprocessupdate__date'] == null))
$error .= "<span class='error'>Incoming Date must not be empty"."</span><br>";

if (isset($_POST['rollprocessupdate__maxdate']) && ($_POST['rollprocessupdate__maxdate'] == "" || $_POST['rollprocessupdate__maxdate'] == null))
$error .= "<span class='error'>Max Date must not be empty"."</span><br>";

if (isset($_POST['rollprocessupdate__deadlinedate']) && ($_POST['rollprocessupdate__deadlinedate'] == "" || $_POST['rollprocessupdate__deadlinedate'] == null))
$error .= "<span class='error'>Deadline Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rollprocessupdate__idstring']))
$data['idstring'] = $_POST['rollprocessupdate__idstring'];if (isset($_POST['rollprocessupdate__noorderandcustomer']))
$data['noorderandcustomer'] = $_POST['rollprocessupdate__noorderandcustomer'];if (isset($_POST['rollprocessupdate__date']))
$this->db->set('date', "str_to_date('".$_POST['rollprocessupdate__date']."', '%d-%m-%Y')", false);if (isset($_POST['rollprocessupdate__qty1']))
$data['qty1'] = $_POST['rollprocessupdate__qty1'];if (isset($_POST['rollprocessupdate__machinetyperoll']))
$data['machinetyperoll'] = $_POST['rollprocessupdate__machinetyperoll'];if (isset($_POST['rollprocessupdate__compound']))
$data['compound'] = $_POST['rollprocessupdate__compound'];if (isset($_POST['rollprocessupdate__rd']))
$data['rd'] = $_POST['rollprocessupdate__rd'];if (isset($_POST['rollprocessupdate__wl']))
$data['wl'] = $_POST['rollprocessupdate__wl'];if (isset($_POST['rollprocessupdate__tl']))
$data['tl'] = $_POST['rollprocessupdate__tl'];if (isset($_POST['rollprocessupdate__qty2']))
$data['qty2'] = $_POST['rollprocessupdate__qty2'];if (isset($_POST['rollprocessupdate__shipping']))
$data['shipping'] = $_POST['rollprocessupdate__shipping'];if (isset($_POST['rollprocessupdate__wrapping']))
$data['wrapping'] = $_POST['rollprocessupdate__wrapping'];if (isset($_POST['rollprocessupdate__vulcanizing']))
$data['vulcanizing'] = $_POST['rollprocessupdate__vulcanizing'];if (isset($_POST['rollprocessupdate__faceoff']))
$data['faceoff'] = $_POST['rollprocessupdate__faceoff'];if (isset($_POST['rollprocessupdate__grinding']))
$data['grinding'] = $_POST['rollprocessupdate__grinding'];if (isset($_POST['rollprocessupdate__polishing']))
$data['polishing'] = $_POST['rollprocessupdate__polishing'];if (isset($_POST['rollprocessupdate__maxdate']))
$this->db->set('maxdate', "str_to_date('".$_POST['rollprocessupdate__maxdate']."', '%d-%m-%Y')", false);if (isset($_POST['rollprocessupdate__deadlinedate']))
$this->db->set('deadlinedate', "str_to_date('".$_POST['rollprocessupdate__deadlinedate']."', '%d-%m-%Y')", false);if (isset($_POST['rollprocessupdate__notes']))
$data['notes'] = $_POST['rollprocessupdate__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('rollprocessupdate', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$rollprocessupdate_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('roll_process_updateadd','rollprocessupdate','aftersave', $rollprocessupdate_id);
			
		
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