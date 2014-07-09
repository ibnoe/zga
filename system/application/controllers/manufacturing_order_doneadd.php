<?php

class manufacturing_order_doneadd extends Controller {

	function manufacturing_order_doneadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['manufacturingorderdone__idstring'] = '';$this->load->library('generallib');
$data['manufacturingorderdone__idstring'] = $this->generallib->genId('Manufacturing Order Done');
$data['manufacturingorderdone__date'] = '';
$data['manufacturingorderdone__notes'] = '';
$data['manufacturingorderdone__lastupdate'] = '';
$data['manufacturingorderdone__updatedby'] = '';
$data['manufacturingorderdone__created'] = '';
$data['manufacturingorderdone__createdby'] = '';if (isset($_POST['idstring']) && $_POST['idstring'] != -1){$data['manufacturingorderdone__idstring'] = $_POST['idstring'];}if (isset($_POST['date']) && $_POST['date'] != -1){$data['manufacturingorderdone__date'] = $_POST['date'];}if (isset($_POST['notes']) && $_POST['notes'] != -1){$data['manufacturingorderdone__notes'] = $_POST['notes'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['manufacturingorderdone__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['manufacturingorderdone__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['manufacturingorderdone__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['manufacturingorderdone__createdby'] = $_POST['createdby'];}
if (!isset($_POST['manufacturingorder__id'])) { echo 'You must at least tick one option'; return; }
$manufacturingorder_ids = $_POST['manufacturingorder__id'];
$linedata = array();
foreach ($manufacturingorder_ids as $manufacturingorder_id)
{
$this->db->where('id', $manufacturingorder_id);
$qq = $this->db->get('manufacturingorder');
if (isset($qq->row()->idstring))
$linedata['manufacturingorderdoneline__idstring'] = $qq->row()->idstring;
else
$linedata['manufacturingorderdoneline__idstring'] = null;
if (isset($qq->row()->date))
$linedata['manufacturingorderdoneline__date'] = $qq->row()->date;
else
$linedata['manufacturingorderdoneline__date'] = null;
if (isset($qq->row()->item_id))
$linedata['manufacturingorderdoneline__item_id'] = $qq->row()->item_id;
else
$linedata['manufacturingorderdoneline__item_id'] = null;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
if (isset($qq->row()->quantitytoprocess))
$linedata['manufacturingorderdoneline__quantitytoprocess'] = $qq->row()->quantitytoprocess;
else
$linedata['manufacturingorderdoneline__quantitytoprocess'] = null;
if (isset($qq->row()->uom_id))
$linedata['manufacturingorderdoneline__uom_id'] = $qq->row()->uom_id;
else
$linedata['manufacturingorderdoneline__uom_id'] = null;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
if (isset($qq->row()->manufacturingorder_id))
$linedata['manufacturingorderdoneline__manufacturingorder_id'] = $qq->row()->manufacturingorder_id;
else
$linedata['manufacturingorderdoneline__manufacturingorder_id'] = null;
$manufacturingorder_opt = array();
$manufacturingorder_opt[''] = 'None';
$q = $this->db->get('manufacturingorder');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $manufacturingorder_opt[$row->id] = $row->idstring; }
$data['manufacturingorder_opt'] = $manufacturingorder_opt;
if (isset($qq->row()->lastupdate))
$linedata['manufacturingorderdoneline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['manufacturingorderdoneline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['manufacturingorderdoneline__updatedby'] = $qq->row()->updatedby;
else
$linedata['manufacturingorderdoneline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['manufacturingorderdoneline__created'] = $qq->row()->created;
else
$linedata['manufacturingorderdoneline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['manufacturingorderdoneline__createdby'] = $qq->row()->createdby;
else
$linedata['manufacturingorderdoneline__createdby'] = null;
$linedata['manufacturingorderdoneline__manufacturingorder_id'] = $manufacturingorder_id;
$data['manufacturingorderdoneline_data'][$manufacturingorder_id] = $linedata;
}
		

		$this->load->view('manufacturing_order_done_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['manufacturingorderdone__idstring']) && ($_POST['manufacturingorderdone__idstring'] == "" || $_POST['manufacturingorderdone__idstring'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['manufacturingorderdone__idstring'])) {
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
$this->db->insert('manufacturingorderdone', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$manufacturingorderdone_id = $this->db->insert_id();


$length = count($_POST['manufacturingorderdoneline__idstring']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['manufacturingorderdoneline__idstring'][$i]))
$coldata[$i]['idstring'] = $_POST['manufacturingorderdoneline__idstring'][$i];
if (isset($_POST['manufacturingorderdoneline__date'][$i]))
$coldata[$i]['date'] = $_POST['manufacturingorderdoneline__date'][$i];
if (isset($_POST['manufacturingorderdoneline__item_id'][$i]))
$coldata[$i]['item_id'] = $_POST['manufacturingorderdoneline__item_id'][$i];
if (isset($_POST['manufacturingorderdoneline__quantitytoprocess'][$i]))
$coldata[$i]['quantitytoprocess'] = $_POST['manufacturingorderdoneline__quantitytoprocess'][$i];
if (isset($_POST['manufacturingorderdoneline__uom_id'][$i]))
$coldata[$i]['uom_id'] = $_POST['manufacturingorderdoneline__uom_id'][$i];
if (isset($_POST['manufacturingorderdoneline__manufacturingorder_id'][$i]))
$coldata[$i]['manufacturingorder_id'] = $_POST['manufacturingorderdoneline__manufacturingorder_id'][$i];
if (isset($_POST['manufacturingorderdoneline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['manufacturingorderdoneline__lastupdate'][$i];
if (isset($_POST['manufacturingorderdoneline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['manufacturingorderdoneline__updatedby'][$i];
if (isset($_POST['manufacturingorderdoneline__created'][$i]))
$coldata[$i]['created'] = $_POST['manufacturingorderdoneline__created'][$i];
if (isset($_POST['manufacturingorderdoneline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['manufacturingorderdoneline__createdby'][$i];
$coldata[$i]['manufacturingorderdone_id'] = $manufacturingorderdone_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('manufacturingorderdoneline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('manufacturing_order_doneadd','manufacturingorderdone','aftersave', $manufacturingorderdone_id);
			
		
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