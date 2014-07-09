<?php

class purchase_return_delivery_lineedit extends Controller {

	function purchase_return_delivery_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_return_delivery_line_id=0)
	{
		if ($purchase_return_delivery_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_return_delivery_line_id);
$this->db->select('*');
$q = $this->db->get('purchasereturndeliveryline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_return_delivery_line_id'] = $purchase_return_delivery_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchasereturndeliveryline__item_id'] = $r->item_id;
$data['purchasereturndeliveryline__quantitytosend'] = $r->quantitytosend;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchasereturndeliveryline__uom_id'] = $r->uom_id;
$data['purchasereturndeliveryline__purchasereturnorderline_id'] = $r->purchasereturnorderline_id;
$data['purchasereturndeliveryline__lastupdate'] = $r->lastupdate;
$data['purchasereturndeliveryline__updatedby'] = $r->updatedby;
$data['purchasereturndeliveryline__created'] = $r->created;
$data['purchasereturndeliveryline__createdby'] = $r->createdby;}
$this->load->view('purchase_return_delivery_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['purchasereturndeliveryline__item_id']) || ($_POST['purchasereturndeliveryline__item_id'] == "" || $_POST['purchasereturndeliveryline__item_id'] == null  || $_POST['purchasereturndeliveryline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['purchasereturndeliveryline__quantitytosend']) && ($_POST['purchasereturndeliveryline__quantitytosend'] == "" || $_POST['purchasereturndeliveryline__quantitytosend'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['purchasereturndeliveryline__uom_id']) || ($_POST['purchasereturndeliveryline__uom_id'] == "" || $_POST['purchasereturndeliveryline__uom_id'] == null  || $_POST['purchasereturndeliveryline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturndeliveryline__item_id']))
$data['item_id'] = $_POST['purchasereturndeliveryline__item_id'];if (isset($_POST['purchasereturndeliveryline__quantitytosend']))
$data['quantitytosend'] = $_POST['purchasereturndeliveryline__quantitytosend'];if (isset($_POST['purchasereturndeliveryline__uom_id']))
$data['uom_id'] = $_POST['purchasereturndeliveryline__uom_id'];if (isset($_POST['purchasereturndeliveryline__purchasereturnorderline_id']))
$data['purchasereturnorderline_id'] = $_POST['purchasereturndeliveryline__purchasereturnorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_return_delivery_line_id']);
$this->db->update('purchasereturndeliveryline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_delivery_lineedit','purchasereturndeliveryline','afteredit', $_POST['purchase_return_delivery_line_id']);
			
			
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