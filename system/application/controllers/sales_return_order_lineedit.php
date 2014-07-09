<?php

class sales_return_order_lineedit extends Controller {

	function sales_return_order_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($sales_return_order_line_id=0)
	{
		if ($sales_return_order_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $sales_return_order_line_id);
$this->db->select('*');
$q = $this->db->get('salesreturnorderline');
if ($q->num_rows() > 0) {
$data = array();
$data['sales_return_order_line_id'] = $sales_return_order_line_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesreturnorderline__item_id'] = $r->item_id;
$data['salesreturnorderline__quantitytoreceive'] = $r->quantitytoreceive;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesreturnorderline__uom_id'] = $r->uom_id;
$data['salesreturnorderline__deliveryorderline_id'] = $r->deliveryorderline_id;
$data['salesreturnorderline__lastupdate'] = $r->lastupdate;
$data['salesreturnorderline__updatedby'] = $r->updatedby;
$data['salesreturnorderline__created'] = $r->created;
$data['salesreturnorderline__createdby'] = $r->createdby;}
$this->load->view('sales_return_order_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['salesreturnorderline__item_id']) || ($_POST['salesreturnorderline__item_id'] == "" || $_POST['salesreturnorderline__item_id'] == null  || $_POST['salesreturnorderline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['salesreturnorderline__quantitytoreceive']) && ($_POST['salesreturnorderline__quantitytoreceive'] == "" || $_POST['salesreturnorderline__quantitytoreceive'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesreturnorderline__uom_id']) || ($_POST['salesreturnorderline__uom_id'] == "" || $_POST['salesreturnorderline__uom_id'] == null  || $_POST['salesreturnorderline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturnorderline__item_id']))
$data['item_id'] = $_POST['salesreturnorderline__item_id'];if (isset($_POST['salesreturnorderline__quantitytoreceive']))
$data['quantitytoreceive'] = $_POST['salesreturnorderline__quantitytoreceive'];if (isset($_POST['salesreturnorderline__uom_id']))
$data['uom_id'] = $_POST['salesreturnorderline__uom_id'];if (isset($_POST['salesreturnorderline__deliveryorderline_id']))
$data['deliveryorderline_id'] = $_POST['salesreturnorderline__deliveryorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['sales_return_order_line_id']);
$this->db->update('salesreturnorderline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_order_lineedit','salesreturnorderline','afteredit', $_POST['sales_return_order_line_id']);
			
			
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