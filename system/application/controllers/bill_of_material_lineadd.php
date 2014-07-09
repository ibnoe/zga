<?php

class bill_of_material_lineadd extends Controller {

	function bill_of_material_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['bom_id'] = $id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['bomline__item_id'] = '';
$data['bomline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['bomline__uom_id'] = '';
$data['bomline__lastupdate'] = '';
$data['bomline__updatedby'] = '';
$data['bomline__created'] = '';
$data['bomline__createdby'] = '';
$bom = array();
$this->db->where('id', $id);
$q = $this->db->get('bom');
if ($q->num_rows() > 0)
$bom = $q->row_array();
$data['bomline__lastupdate'] = $bom['lastupdate'];
$data['bomline__updatedby'] = $bom['updatedby'];
$data['bomline__created'] = $bom['created'];
$data['bomline__createdby'] = $bom['createdby'];
		

		$this->load->view('bill_of_material_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['bomline__item_id']) || ($_POST['bomline__item_id'] == "" || $_POST['bomline__item_id'] == null  || $_POST['bomline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['bomline__quantity']) && ($_POST['bomline__quantity'] == "" || $_POST['bomline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['bomline__uom_id']) || ($_POST['bomline__uom_id'] == "" || $_POST['bomline__uom_id'] == null  || $_POST['bomline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['bom_id'] = $_POST['bom_id'];if (isset($_POST['bomline__item_id']))
$data['item_id'] = $_POST['bomline__item_id'];if (isset($_POST['bomline__quantity']))
$data['quantity'] = $_POST['bomline__quantity'];if (isset($_POST['bomline__uom_id']))
$data['uom_id'] = $_POST['bomline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('bomline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$bomline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('bill_of_material_lineadd','bomline','aftersave', $bomline_id);
			
		
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