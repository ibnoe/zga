<?php

class giro_in_clearanceadd extends Controller {

	function giro_in_clearanceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['giroinclearance__date'] = '';
$data['giroinclearance__idstring'] = '';$this->load->library('generallib');
$data['giroinclearance__idstring'] = $this->generallib->genId('Giro In Clearance');
$data['giroinclearance__notes'] = '';
$data['giroinclearance__lastupdate'] = '';
$data['giroinclearance__updatedby'] = '';
$data['giroinclearance__created'] = '';
$data['giroinclearance__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['giroinclearance__date'] = $_POST['date'];}if (isset($_POST['idstring']) && $_POST['idstring'] != -1){$data['giroinclearance__idstring'] = $_POST['idstring'];}if (isset($_POST['notes']) && $_POST['notes'] != -1){$data['giroinclearance__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['giroinclearance__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['giroinclearance__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['giroinclearance__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['giroinclearance__createdby'] = $_POST['createdby'];}
if (!isset($_POST['giroin__id'])) { echo 'You must at least tick one option'; return; }
$giroin_ids = $_POST['giroin__id'];
$linedata = array();
foreach ($giroin_ids as $giroin_id)
{
$this->db->where('id', $giroin_id);
$qq = $this->db->get('giroin');
if (isset($qq->row()->giroin_id))
$linedata['giroinclearanceline__giroin_id'] = $qq->row()->giroin_id;
else
$linedata['giroinclearanceline__giroin_id'] = null;
$giroin_opt = array();
$giroin_opt[''] = 'None';
$q = $this->db->get('giroin');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
if (isset($qq->row()->lastupdate))
$linedata['giroinclearanceline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['giroinclearanceline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['giroinclearanceline__updatedby'] = $qq->row()->updatedby;
else
$linedata['giroinclearanceline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['giroinclearanceline__created'] = $qq->row()->created;
else
$linedata['giroinclearanceline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['giroinclearanceline__createdby'] = $qq->row()->createdby;
else
$linedata['giroinclearanceline__createdby'] = null;
$linedata['giroinclearanceline__giroin_id'] = $giroin_id;
$data['giroinclearanceline_data'][$giroin_id] = $linedata;
}
		

		$this->load->view('giro_in_clearance_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['giroinclearance__date']) && ($_POST['giroinclearance__date'] == "" || $_POST['giroinclearance__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['giroinclearance__idstring']) && ($_POST['giroinclearance__idstring'] == "" || $_POST['giroinclearance__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['giroinclearance__idstring'])) {
$this->db->where('idstring', $_POST['giroinclearance__idstring']);
$q = $this->db->get('giroinclearance');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['giroinclearance__date']))
$this->db->set('date', "str_to_date('".$_POST['giroinclearance__date']."', '%d-%m-%Y')", false);if (isset($_POST['giroinclearance__idstring']))
$data['idstring'] = $_POST['giroinclearance__idstring'];if (isset($_POST['giroinclearance__notes']))
$data['notes'] = $_POST['giroinclearance__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('giroinclearance', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$giroinclearance_id = $this->db->insert_id();


$length = count($_POST['giroinclearanceline__giroin_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['giroinclearanceline__giroin_id'][$i]))
$coldata[$i]['giroin_id'] = $_POST['giroinclearanceline__giroin_id'][$i];
if (isset($_POST['giroinclearanceline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['giroinclearanceline__lastupdate'][$i];
if (isset($_POST['giroinclearanceline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['giroinclearanceline__updatedby'][$i];
if (isset($_POST['giroinclearanceline__created'][$i]))
$coldata[$i]['created'] = $_POST['giroinclearanceline__created'][$i];
if (isset($_POST['giroinclearanceline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['giroinclearanceline__createdby'][$i];
$coldata[$i]['giroinclearance_id'] = $giroinclearance_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('giroinclearanceline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('giro_in_clearanceadd','giroinclearance','aftersave', $giroinclearance_id);
			
		
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