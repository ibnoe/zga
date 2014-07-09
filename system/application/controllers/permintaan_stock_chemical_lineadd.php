<?php

class permintaan_stock_chemical_lineadd extends Controller {

	function permintaan_stock_chemical_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['permintaanstockchemical_id'] = $id;
$data['permintaanstockchemicalline__idstring'] = '';
$data['permintaanstockchemicalline__date'] = '';
$data['permintaanstockchemicalline__notes'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['permintaanstockchemicalline__item_id'] = '';
$data['permintaanstockchemicalline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['permintaanstockchemicalline__uom_id'] = '';
$data['permintaanstockchemicalline__lastupdate'] = '';
$data['permintaanstockchemicalline__updatedby'] = '';
$data['permintaanstockchemicalline__created'] = '';
$data['permintaanstockchemicalline__createdby'] = '';
$permintaanstockchemical = array();
$this->db->where('id', $id);
$q = $this->db->get('permintaanstockchemical');
if ($q->num_rows() > 0)
$permintaanstockchemical = $q->row_array();
$data['permintaanstockchemicalline__idstring'] = $permintaanstockchemical['idstring'];
$data['permintaanstockchemicalline__date'] = $permintaanstockchemical['date'];
$data['permintaanstockchemicalline__notes'] = $permintaanstockchemical['notes'];
$data['permintaanstockchemicalline__lastupdate'] = $permintaanstockchemical['lastupdate'];
$data['permintaanstockchemicalline__updatedby'] = $permintaanstockchemical['updatedby'];
$data['permintaanstockchemicalline__created'] = $permintaanstockchemical['created'];
$data['permintaanstockchemicalline__createdby'] = $permintaanstockchemical['createdby'];
		

		$this->load->view('permintaan_stock_chemical_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['permintaanstockchemicalline__item_id']) || ($_POST['permintaanstockchemicalline__item_id'] == "" || $_POST['permintaanstockchemicalline__item_id'] == null  || $_POST['permintaanstockchemicalline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['permintaanstockchemicalline__quantity']) && ($_POST['permintaanstockchemicalline__quantity'] == "" || $_POST['permintaanstockchemicalline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['permintaanstockchemicalline__uom_id']) || ($_POST['permintaanstockchemicalline__uom_id'] == "" || $_POST['permintaanstockchemicalline__uom_id'] == null  || $_POST['permintaanstockchemicalline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['permintaanstockchemical_id'] = $_POST['permintaanstockchemical_id'];if (isset($_POST['permintaanstockchemicalline__idstring']))
$data['idstring'] = $_POST['permintaanstockchemicalline__idstring'];if (isset($_POST['permintaanstockchemicalline__date']))
$data['date'] = $_POST['permintaanstockchemicalline__date'];if (isset($_POST['permintaanstockchemicalline__notes']))
$data['notes'] = $_POST['permintaanstockchemicalline__notes'];if (isset($_POST['permintaanstockchemicalline__item_id']))
$data['item_id'] = $_POST['permintaanstockchemicalline__item_id'];if (isset($_POST['permintaanstockchemicalline__quantity']))
$data['quantity'] = $_POST['permintaanstockchemicalline__quantity'];if (isset($_POST['permintaanstockchemicalline__uom_id']))
$data['uom_id'] = $_POST['permintaanstockchemicalline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('permintaanstockchemicalline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$permintaanstockchemicalline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('permintaan_stock_chemical_lineadd','permintaanstockchemicalline','aftersave', $permintaanstockchemicalline_id);
			
		
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