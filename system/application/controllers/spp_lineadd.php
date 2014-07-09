<?php

class spp_lineadd extends Controller {

	function spp_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['suratpermintaanpembelian_id'] = $id;
$data['suratpermintaanpembelianline__orderid'] = '';
$data['suratpermintaanpembelianline__date'] = '';
$data['suratpermintaanpembelianline__notes'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['suratpermintaanpembelianline__item_id'] = '';
$data['suratpermintaanpembelianline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['suratpermintaanpembelianline__uom_id'] = '';
$data['suratpermintaanpembelianline__lastupdate'] = '';
$data['suratpermintaanpembelianline__updatedby'] = '';
$data['suratpermintaanpembelianline__created'] = '';
$data['suratpermintaanpembelianline__createdby'] = '';
$suratpermintaanpembelian = array();
$this->db->where('id', $id);
$q = $this->db->get('suratpermintaanpembelian');
if ($q->num_rows() > 0)
$suratpermintaanpembelian = $q->row_array();
$data['suratpermintaanpembelianline__orderid'] = $suratpermintaanpembelian['orderid'];
$data['suratpermintaanpembelianline__date'] = $suratpermintaanpembelian['date'];
$data['suratpermintaanpembelianline__notes'] = $suratpermintaanpembelian['notes'];
$data['suratpermintaanpembelianline__lastupdate'] = $suratpermintaanpembelian['lastupdate'];
$data['suratpermintaanpembelianline__updatedby'] = $suratpermintaanpembelian['updatedby'];
$data['suratpermintaanpembelianline__created'] = $suratpermintaanpembelian['created'];
$data['suratpermintaanpembelianline__createdby'] = $suratpermintaanpembelian['createdby'];
		

		$this->load->view('spp_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['suratpermintaanpembelianline__item_id']) || ($_POST['suratpermintaanpembelianline__item_id'] == "" || $_POST['suratpermintaanpembelianline__item_id'] == null  || $_POST['suratpermintaanpembelianline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['suratpermintaanpembelianline__quantity']) && ($_POST['suratpermintaanpembelianline__quantity'] == "" || $_POST['suratpermintaanpembelianline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['suratpermintaanpembelianline__uom_id']) || ($_POST['suratpermintaanpembelianline__uom_id'] == "" || $_POST['suratpermintaanpembelianline__uom_id'] == null  || $_POST['suratpermintaanpembelianline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['suratpermintaanpembelian_id'] = $_POST['suratpermintaanpembelian_id'];if (isset($_POST['suratpermintaanpembelianline__orderid']))
$data['orderid'] = $_POST['suratpermintaanpembelianline__orderid'];if (isset($_POST['suratpermintaanpembelianline__date']))
$data['date'] = $_POST['suratpermintaanpembelianline__date'];if (isset($_POST['suratpermintaanpembelianline__notes']))
$data['notes'] = $_POST['suratpermintaanpembelianline__notes'];if (isset($_POST['suratpermintaanpembelianline__item_id']))
$data['item_id'] = $_POST['suratpermintaanpembelianline__item_id'];if (isset($_POST['suratpermintaanpembelianline__quantity']))
$data['quantity'] = $_POST['suratpermintaanpembelianline__quantity'];if (isset($_POST['suratpermintaanpembelianline__uom_id']))
$data['uom_id'] = $_POST['suratpermintaanpembelianline__uom_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('suratpermintaanpembelianline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$suratpermintaanpembelianline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('spp_lineadd','suratpermintaanpembelianline','aftersave', $suratpermintaanpembelianline_id);
			
		
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