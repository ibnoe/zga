<?php

class sales_return_order_lineadd extends Controller {

	function sales_return_order_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesreturnorderline__item_id'] = '';
$data['salesreturnorderline__quantitytoreceive'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesreturnorderline__uom_id'] = '';
$deliveryorderline_opt = array();
$deliveryorderline_opt[''] = 'None';
$q = $this->db->get('deliveryorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $deliveryorderline_opt[$row->id] = $row->orderid; }
$data['deliveryorderline_opt'] = $deliveryorderline_opt;
$data['salesreturnorderline__deliveryorderline_id'] = '';
$data['salesreturnorderline__lastupdate'] = '';
$data['salesreturnorderline__updatedby'] = '';
$data['salesreturnorderline__created'] = '';
$data['salesreturnorderline__createdby'] = '';
		

		$this->load->view('sales_return_order_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['salesreturnorderline__item_id']) || ($_POST['salesreturnorderline__item_id'] == "" || $_POST['salesreturnorderline__item_id'] == null  || $_POST['salesreturnorderline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['salesreturnorderline__quantitytoreceive']) && ($_POST['salesreturnorderline__quantitytoreceive'] == "" || $_POST['salesreturnorderline__quantitytoreceive'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesreturnorderline__uom_id']) || ($_POST['salesreturnorderline__uom_id'] == "" || $_POST['salesreturnorderline__uom_id'] == null  || $_POST['salesreturnorderline__uom_id'] == null))
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
$this->db->insert('salesreturnorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturnorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_order_lineadd','salesreturnorderline','aftersave', $salesreturnorderline_id);
			
		
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