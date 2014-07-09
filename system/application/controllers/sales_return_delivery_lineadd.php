<?php

class sales_return_delivery_lineadd extends Controller {

	function sales_return_delivery_lineadd()
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
$data['salesreturndeliveryline__item_id'] = '';
$data['salesreturndeliveryline__quantitytoreceive'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesreturndeliveryline__uom_id'] = '';
$salesreturnorderline_opt = array();
$salesreturnorderline_opt[''] = 'None';
$q = $this->db->get('salesreturnorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesreturnorderline_opt[$row->id] = $row->salesreturnorderid; }
$data['salesreturnorderline_opt'] = $salesreturnorderline_opt;
$data['salesreturndeliveryline__salesreturnorderline_id'] = '';
$data['salesreturndeliveryline__lastupdate'] = '';
$data['salesreturndeliveryline__updatedby'] = '';
$data['salesreturndeliveryline__created'] = '';
$data['salesreturndeliveryline__createdby'] = '';
		

		$this->load->view('sales_return_delivery_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['salesreturndeliveryline__item_id']) || ($_POST['salesreturndeliveryline__item_id'] == "" || $_POST['salesreturndeliveryline__item_id'] == null  || $_POST['salesreturndeliveryline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['salesreturndeliveryline__quantitytoreceive']) && ($_POST['salesreturndeliveryline__quantitytoreceive'] == "" || $_POST['salesreturndeliveryline__quantitytoreceive'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesreturndeliveryline__uom_id']) || ($_POST['salesreturndeliveryline__uom_id'] == "" || $_POST['salesreturndeliveryline__uom_id'] == null  || $_POST['salesreturndeliveryline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturndeliveryline__item_id']))
$data['item_id'] = $_POST['salesreturndeliveryline__item_id'];if (isset($_POST['salesreturndeliveryline__quantitytoreceive']))
$data['quantitytoreceive'] = $_POST['salesreturndeliveryline__quantitytoreceive'];if (isset($_POST['salesreturndeliveryline__uom_id']))
$data['uom_id'] = $_POST['salesreturndeliveryline__uom_id'];if (isset($_POST['salesreturndeliveryline__salesreturnorderline_id']))
$data['salesreturnorderline_id'] = $_POST['salesreturndeliveryline__salesreturnorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesreturndeliveryline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturndeliveryline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_delivery_lineadd','salesreturndeliveryline','aftersave', $salesreturndeliveryline_id);
			
		
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