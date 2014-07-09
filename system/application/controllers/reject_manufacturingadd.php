<?php

class reject_manufacturingadd extends Controller {

	function reject_manufacturingadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['rejectmanufacturing__idstring'] = '';$this->load->library('generallib');
$data['rejectmanufacturing__idstring'] = $this->generallib->genId('Reject Manufacturing');
$data['rejectmanufacturing__date'] = '';
$manufacturingrejectreason_opt = array();
$manufacturingrejectreason_opt[''] = 'None';
$q = $this->db->get('manufacturingrejectreason');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $manufacturingrejectreason_opt[$row->id] = $row->name; }
$data['manufacturingrejectreason_opt'] = $manufacturingrejectreason_opt;
$data['rejectmanufacturing__manufacturingrejectreason_id'] = '';
$data['rejectmanufacturing__notes'] = '';
$data['rejectmanufacturing__lastupdate'] = '';
$data['rejectmanufacturing__updatedby'] = '';
$data['rejectmanufacturing__created'] = '';
$data['rejectmanufacturing__createdby'] = '';if (isset($_POST['idstring']) && $_POST['idstring'] != -1){$data['rejectmanufacturing__idstring'] = $_POST['idstring'];}if (isset($_POST['date']) && $_POST['date'] != -1){$data['rejectmanufacturing__date'] = $_POST['date'];}if (isset($_POST['manufacturingrejectreason_id']) && $_POST['manufacturingrejectreason_id'] != -1){$data['rejectmanufacturing__manufacturingrejectreason_id'] = $_POST['manufacturingrejectreason_id'];}if (isset($_POST['notes']) && $_POST['notes'] != -1){$data['rejectmanufacturing__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['rejectmanufacturing__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['rejectmanufacturing__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['rejectmanufacturing__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['rejectmanufacturing__createdby'] = $_POST['createdby'];}
if (!isset($_POST['manufacturingorderdoneline__id'])) { echo 'You must at least tick one option'; return; }
$manufacturingorderdoneline_ids = $_POST['manufacturingorderdoneline__id'];
$linedata = array();
foreach ($manufacturingorderdoneline_ids as $manufacturingorderdoneline_id)
{
$this->db->where('id', $manufacturingorderdoneline_id);
$qq = $this->db->get('manufacturingorderdoneline');
if (isset($qq->row()->manufacturingrejectreason_id)) {
if ($data['rejectmanufacturing__manufacturingrejectreason_id'] > 0 && $data['rejectmanufacturing__manufacturingrejectreason_id'] != $qq->row()->manufacturingrejectreason_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['rejectmanufacturing__manufacturingrejectreason_id'] = $qq->row()->manufacturingrejectreason_id;
}
if (isset($qq->row()->item_id))
$linedata['rejectmanufacturingline__item_id'] = $qq->row()->item_id;
else
$linedata['rejectmanufacturingline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytoprocess))
$linedata['rejectmanufacturingline__quantitytoprocess'] = $qq->row()->quantitytoprocess;
else
$linedata['rejectmanufacturingline__quantitytoprocess'] = null;
if (isset($qq->row()->uom_id))
$linedata['rejectmanufacturingline__uom_id'] = $qq->row()->uom_id;
else
$linedata['rejectmanufacturingline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->manufacturingorderdoneline_id))
$linedata['rejectmanufacturingline__manufacturingorderdoneline_id'] = $qq->row()->manufacturingorderdoneline_id;
else
$linedata['rejectmanufacturingline__manufacturingorderdoneline_id'] = null;
$manufacturingorderdoneline_opt = array();
$manufacturingorderdoneline_opt[''] = 'None';
$q = $this->db->get('manufacturingorderdoneline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $manufacturingorderdoneline_opt[$row->id] = $row->idstring; }
$data['manufacturingorderdoneline_opt'] = $manufacturingorderdoneline_opt;
if (isset($qq->row()->lastupdate))
$linedata['rejectmanufacturingline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['rejectmanufacturingline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['rejectmanufacturingline__updatedby'] = $qq->row()->updatedby;
else
$linedata['rejectmanufacturingline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['rejectmanufacturingline__created'] = $qq->row()->created;
else
$linedata['rejectmanufacturingline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['rejectmanufacturingline__createdby'] = $qq->row()->createdby;
else
$linedata['rejectmanufacturingline__createdby'] = null;
$linedata['rejectmanufacturingline__manufacturingorderdoneline_id'] = $manufacturingorderdoneline_id;
$data['rejectmanufacturingline_data'][$manufacturingorderdoneline_id] = $linedata;
}
		

		$this->load->view('reject_manufacturing_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['rejectmanufacturing__idstring']) && ($_POST['rejectmanufacturing__idstring'] == "" || $_POST['rejectmanufacturing__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['rejectmanufacturing__idstring'])) {
$this->db->where('idstring', $_POST['rejectmanufacturing__idstring']);
$q = $this->db->get('rejectmanufacturing');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (isset($_POST['rejectmanufacturing__date']) && ($_POST['rejectmanufacturing__date'] == "" || $_POST['rejectmanufacturing__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (!isset($_POST['rejectmanufacturing__manufacturingrejectreason_id']) || ($_POST['rejectmanufacturing__manufacturingrejectreason_id'] == "" || $_POST['rejectmanufacturing__manufacturingrejectreason_id'] == null  || $_POST['rejectmanufacturing__manufacturingrejectreason_id'] == null))
$error .= "<span class='error'>Manufacturing Reject Reason must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['rejectmanufacturing__idstring']))
$data['idstring'] = $_POST['rejectmanufacturing__idstring'];if (isset($_POST['rejectmanufacturing__date']))
$this->db->set('date', "str_to_date('".$_POST['rejectmanufacturing__date']."', '%d-%m-%Y')", false);if (isset($_POST['rejectmanufacturing__manufacturingrejectreason_id']))
$data['manufacturingrejectreason_id'] = $_POST['rejectmanufacturing__manufacturingrejectreason_id'];if (isset($_POST['rejectmanufacturing__notes']))
$data['notes'] = $_POST['rejectmanufacturing__notes'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('rejectmanufacturing', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$rejectmanufacturing_id = $this->db->insert_id();


$length = count($_POST['rejectmanufacturingline__item_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['rejectmanufacturingline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['rejectmanufacturingline__item_id'][$i];
if (isset($_POST['rejectmanufacturingline__quantitytoprocess'][$i]))
$coldata[$i]['quantitytoprocess'] = $_POST['rejectmanufacturingline__quantitytoprocess'][$i];
if (isset($_POST['rejectmanufacturingline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['rejectmanufacturingline__uom_id'][$i];
if (isset($_POST['rejectmanufacturingline__manufacturingorderdoneline_id'][$i]))
$coldata[$i]['manufacturingorderdoneline_id'] = $_POST['rejectmanufacturingline__manufacturingorderdoneline_id'][$i];
if (isset($_POST['rejectmanufacturingline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['rejectmanufacturingline__lastupdate'][$i];
if (isset($_POST['rejectmanufacturingline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['rejectmanufacturingline__updatedby'][$i];
if (isset($_POST['rejectmanufacturingline__created'][$i]))
$coldata[$i]['created'] = $_POST['rejectmanufacturingline__created'][$i];
if (isset($_POST['rejectmanufacturingline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['rejectmanufacturingline__createdby'][$i];
$coldata[$i]['rejectmanufacturing_id'] = $rejectmanufacturing_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('rejectmanufacturingline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('reject_manufacturingadd','rejectmanufacturing','aftersave', $rejectmanufacturing_id);
			
		
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