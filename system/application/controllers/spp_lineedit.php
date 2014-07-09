<?php

class spp_lineedit extends Controller {

	function spp_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($spp_line_id=0)
	{
		if ($spp_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $spp_line_id);
$this->db->select('*');
$q = $this->db->get('suratpermintaanpembelianline');
if ($q->num_rows() > 0) {
$data = array();
$data['spp_line_id'] = $spp_line_id;
foreach ($q->result() as $r) {
$data['suratpermintaanpembelianline__orderid'] = $r->orderid;
$data['suratpermintaanpembelianline__date'] = $r->date;
$data['suratpermintaanpembelianline__notes'] = $r->notes;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['suratpermintaanpembelianline__item_id'] = $r->item_id;
$data['suratpermintaanpembelianline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['suratpermintaanpembelianline__uom_id'] = $r->uom_id;
$data['suratpermintaanpembelianline__lastupdate'] = $r->lastupdate;
$data['suratpermintaanpembelianline__updatedby'] = $r->updatedby;
$data['suratpermintaanpembelianline__created'] = $r->created;
$data['suratpermintaanpembelianline__createdby'] = $r->createdby;}
$this->load->view('spp_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['suratpermintaanpembelianline__item_id']) || ($_POST['suratpermintaanpembelianline__item_id'] == "" || $_POST['suratpermintaanpembelianline__item_id'] == null  || $_POST['suratpermintaanpembelianline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['suratpermintaanpembelianline__quantity']) && ($_POST['suratpermintaanpembelianline__quantity'] == "" || $_POST['suratpermintaanpembelianline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['suratpermintaanpembelianline__uom_id']) || ($_POST['suratpermintaanpembelianline__uom_id'] == "" || $_POST['suratpermintaanpembelianline__uom_id'] == null  || $_POST['suratpermintaanpembelianline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['suratpermintaanpembelianline__orderid']))
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
$this->db->where('id', $_POST['spp_line_id']);
$this->db->update('suratpermintaanpembelianline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('spp_lineedit','suratpermintaanpembelianline','afteredit', $_POST['spp_line_id']);
			
			
			if ($error == "")
			{
				echo "<span style='background-color:green'>   </span> "."record successfully updated.";
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