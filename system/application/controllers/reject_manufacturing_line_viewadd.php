<?php

class reject_manufacturing_line_viewadd extends Controller {

	function reject_manufacturing_line_viewadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['rejectmanufacturing_id'] = $id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['rejectmanufacturingline__item_id'] = '';
$data['rejectmanufacturingline__quantitytoprocess'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['rejectmanufacturingline__uom_id'] = '';
$manufacturingorderdoneline_opt = array();
$manufacturingorderdoneline_opt[''] = 'None';
$q = $this->db->get('manufacturingorderdoneline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $manufacturingorderdoneline_opt[$row->id] = $row->idstring; }
$data['manufacturingorderdoneline_opt'] = $manufacturingorderdoneline_opt;
$data['rejectmanufacturingline__manufacturingorderdoneline_id'] = '';
$data['rejectmanufacturingline__lastupdate'] = '';
$data['rejectmanufacturingline__updatedby'] = '';
$data['rejectmanufacturingline__created'] = '';
$data['rejectmanufacturingline__createdby'] = '';
		

		$this->load->view('reject_manufacturing_line_view_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['rejectmanufacturingline__item_id']) || ($_POST['rejectmanufacturingline__item_id'] == "" || $_POST['rejectmanufacturingline__item_id'] == null  || $_POST['rejectmanufacturingline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['rejectmanufacturingline__quantitytoprocess']) && ($_POST['rejectmanufacturingline__quantitytoprocess'] == "" || $_POST['rejectmanufacturingline__quantitytoprocess'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['rejectmanufacturingline__uom_id']) || ($_POST['rejectmanufacturingline__uom_id'] == "" || $_POST['rejectmanufacturingline__uom_id'] == null  || $_POST['rejectmanufacturingline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['rejectmanufacturing_id'] = $_POST['rejectmanufacturing_id'];if (isset($_POST['rejectmanufacturingline__item_id']))
$data['item_id'] = $_POST['rejectmanufacturingline__item_id'];if (isset($_POST['rejectmanufacturingline__quantitytoprocess']))
$data['quantitytoprocess'] = $_POST['rejectmanufacturingline__quantitytoprocess'];if (isset($_POST['rejectmanufacturingline__uom_id']))
$data['uom_id'] = $_POST['rejectmanufacturingline__uom_id'];if (isset($_POST['rejectmanufacturingline__manufacturingorderdoneline_id']))
$data['manufacturingorderdoneline_id'] = $_POST['rejectmanufacturingline__manufacturingorderdoneline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('rejectmanufacturingline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$rejectmanufacturingline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('reject_manufacturing_line_viewadd','rejectmanufacturingline','aftersave', $rejectmanufacturingline_id);
			
		
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