<?php

class permintaan_stock_lineadd extends Controller {

	function permintaan_stock_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['permintaanstock_id'] = $id;
$data['permintaanstockline__idstring'] = '';
$data['permintaanstockline__date'] = '';
$data['permintaanstockline__notes'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['permintaanstockline__item_id'] = '';
$data['permintaanstockline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['permintaanstockline__uom_id'] = '';
$data['permintaanstockline__lastupdate'] = '';
$data['permintaanstockline__updatedby'] = '';
$data['permintaanstockline__created'] = '';
$data['permintaanstockline__createdby'] = '';
$permintaanstock = array();
$this->db->where('id', $id);
$q = $this->db->get('permintaanstock');
if ($q->num_rows() > 0)
$permintaanstock = $q->row_array();
$data['permintaanstockline__idstring'] = $permintaanstock['idstring'];
$data['permintaanstockline__date'] = $permintaanstock['date'];
$data['permintaanstockline__notes'] = $permintaanstock['notes'];
$data['permintaanstockline__lastupdate'] = $permintaanstock['lastupdate'];
$data['permintaanstockline__updatedby'] = $permintaanstock['updatedby'];
$data['permintaanstockline__created'] = $permintaanstock['created'];
$data['permintaanstockline__createdby'] = $permintaanstock['createdby'];
		

		$this->load->view('permintaan_stock_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['permintaanstockline__item_id']) || ($_POST['permintaanstockline__item_id'] == "" || $_POST['permintaanstockline__item_id'] == null  || $_POST['permintaanstockline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['permintaanstockline__quantity']) && ($_POST['permintaanstockline__quantity'] == "" || $_POST['permintaanstockline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['permintaanstockline__uom_id']) || ($_POST['permintaanstockline__uom_id'] == "" || $_POST['permintaanstockline__uom_id'] == null  || $_POST['permintaanstockline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['permintaanstock_id'] = $_POST['permintaanstock_id'];if (isset($_POST['permintaanstockline__idstring']))
$data['idstring'] = $_POST['permintaanstockline__idstring'];if (isset($_POST['permintaanstockline__date']))
$data['date'] = $_POST['permintaanstockline__date'];if (isset($_POST['permintaanstockline__notes']))
$data['notes'] = $_POST['permintaanstockline__notes'];if (isset($_POST['permintaanstockline__item_id']))
$data['item_id'] = $_POST['permintaanstockline__item_id'];if (isset($_POST['permintaanstockline__quantity']))
$data['quantity'] = $_POST['permintaanstockline__quantity'];if (isset($_POST['permintaanstockline__uom_id']))
$data['uom_id'] = $_POST['permintaanstockline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('permintaanstockline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$permintaanstockline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('permintaan_stock_lineadd','permintaanstockline','aftersave', $permintaanstockline_id);
			
		
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