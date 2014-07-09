<?php

class giro_out_clearanceadd extends Controller {

	function giro_out_clearanceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['girooutclearance__date'] = '';
$data['girooutclearance__idstring'] = '';$this->load->library('generallib');
$data['girooutclearance__idstring'] = $this->generallib->genId('Giro Out Clearance');
$data['girooutclearance__notes'] = '';
$data['girooutclearance__lastupdate'] = '';
$data['girooutclearance__updatedby'] = '';
$data['girooutclearance__created'] = '';
$data['girooutclearance__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['girooutclearance__date'] = $_POST['date'];}if (isset($_POST['idstring']) && $_POST['idstring'] != -1){$data['girooutclearance__idstring'] = $_POST['idstring'];}if (isset($_POST['notes']) && $_POST['notes'] != -1){$data['girooutclearance__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['girooutclearance__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['girooutclearance__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['girooutclearance__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['girooutclearance__createdby'] = $_POST['createdby'];}
if (!isset($_POST['giroout__id'])) { echo 'You must at least tick one option'; return; }
$giroout_ids = $_POST['giroout__id'];
$linedata = array();
foreach ($giroout_ids as $giroout_id)
{
$this->db->where('id', $giroout_id);
$qq = $this->db->get('giroout');
if (isset($qq->row()->giroout_id))
$linedata['girooutclearanceline__giroout_id'] = $qq->row()->giroout_id;
else
$linedata['girooutclearanceline__giroout_id'] = null;
$giroout_opt = array();
$giroout_opt[''] = 'None';
$q = $this->db->get('giroout');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
if (isset($qq->row()->lastupdate))
$linedata['girooutclearanceline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['girooutclearanceline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['girooutclearanceline__updatedby'] = $qq->row()->updatedby;
else
$linedata['girooutclearanceline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['girooutclearanceline__created'] = $qq->row()->created;
else
$linedata['girooutclearanceline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['girooutclearanceline__createdby'] = $qq->row()->createdby;
else
$linedata['girooutclearanceline__createdby'] = null;
$linedata['girooutclearanceline__giroout_id'] = $giroout_id;
$data['girooutclearanceline_data'][$giroout_id] = $linedata;
}
		

		$this->load->view('giro_out_clearance_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['girooutclearance__date']) && ($_POST['girooutclearance__date'] == "" || $_POST['girooutclearance__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['girooutclearance__idstring']) && ($_POST['girooutclearance__idstring'] == "" || $_POST['girooutclearance__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['girooutclearance__idstring'])) {
$this->db->where('idstring', $_POST['girooutclearance__idstring']);
$q = $this->db->get('girooutclearance');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['girooutclearance__date']))
$this->db->set('date', "str_to_date('".$_POST['girooutclearance__date']."', '%d-%m-%Y')", false);if (isset($_POST['girooutclearance__idstring']))
$data['idstring'] = $_POST['girooutclearance__idstring'];if (isset($_POST['girooutclearance__notes']))
$data['notes'] = $_POST['girooutclearance__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('girooutclearance', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$girooutclearance_id = $this->db->insert_id();


$length = count($_POST['girooutclearanceline__giroout_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['girooutclearanceline__giroout_id'][$i]))
$coldata[$i]['giroout_id'] = $_POST['girooutclearanceline__giroout_id'][$i];
if (isset($_POST['girooutclearanceline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['girooutclearanceline__lastupdate'][$i];
if (isset($_POST['girooutclearanceline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['girooutclearanceline__updatedby'][$i];
if (isset($_POST['girooutclearanceline__created'][$i]))
$coldata[$i]['created'] = $_POST['girooutclearanceline__created'][$i];
if (isset($_POST['girooutclearanceline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['girooutclearanceline__createdby'][$i];
$coldata[$i]['girooutclearance_id'] = $girooutclearance_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('girooutclearanceline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_out_clearanceadd','girooutclearance','aftersave', $girooutclearance_id);
			
		
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