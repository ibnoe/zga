<?php

class purchase_return_order_line_viewadd extends Controller {

	function purchase_return_order_line_viewadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['purchasereturnorder_id'] = $id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchasereturnorderline__item_id'] = '';
$data['purchasereturnorderline__quantitytosend'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchasereturnorderline__uom_id'] = '';
$receiveditemline_opt = array();
$receiveditemline_opt[''] = 'None';
$q = $this->db->get('receiveditemline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $receiveditemline_opt[$row->id] = $row->orderid; }
$data['receiveditemline_opt'] = $receiveditemline_opt;
$data['purchasereturnorderline__receiveditemline_id'] = '';
$data['purchasereturnorderline__lastupdate'] = '';
$data['purchasereturnorderline__updatedby'] = '';
$data['purchasereturnorderline__created'] = '';
$data['purchasereturnorderline__createdby'] = '';
		

		$this->load->view('purchase_return_order_line_view_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['purchasereturnorderline__item_id']) || ($_POST['purchasereturnorderline__item_id'] == "" || $_POST['purchasereturnorderline__item_id'] == null  || $_POST['purchasereturnorderline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['purchasereturnorderline__quantitytosend']) && ($_POST['purchasereturnorderline__quantitytosend'] == "" || $_POST['purchasereturnorderline__quantitytosend'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['purchasereturnorderline__uom_id']) || ($_POST['purchasereturnorderline__uom_id'] == "" || $_POST['purchasereturnorderline__uom_id'] == null  || $_POST['purchasereturnorderline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['purchasereturnorder_id'] = $_POST['purchasereturnorder_id'];if (isset($_POST['purchasereturnorderline__item_id']))
$data['item_id'] = $_POST['purchasereturnorderline__item_id'];if (isset($_POST['purchasereturnorderline__quantitytosend']))
$data['quantitytosend'] = $_POST['purchasereturnorderline__quantitytosend'];if (isset($_POST['purchasereturnorderline__uom_id']))
$data['uom_id'] = $_POST['purchasereturnorderline__uom_id'];if (isset($_POST['purchasereturnorderline__receiveditemline_id']))
$data['receiveditemline_id'] = $_POST['purchasereturnorderline__receiveditemline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturnorderline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturnorderline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_order_line_viewadd','purchasereturnorderline','aftersave', $purchasereturnorderline_id);
			
		
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