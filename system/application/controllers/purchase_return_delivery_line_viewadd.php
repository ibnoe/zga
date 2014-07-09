<?php

class purchase_return_delivery_line_viewadd extends Controller {

	function purchase_return_delivery_line_viewadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['purchasereturndelivery_id'] = $id;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchasereturndeliveryline__item_id'] = '';
$data['purchasereturndeliveryline__quantitytosend'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchasereturndeliveryline__uom_id'] = '';
$purchasereturnorderline_opt = array();
$purchasereturnorderline_opt[''] = 'None';
$q = $this->db->get('purchasereturnorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchasereturnorderline_opt[$row->id] = $row->purchasereturnorderid; }
$data['purchasereturnorderline_opt'] = $purchasereturnorderline_opt;
$data['purchasereturndeliveryline__purchasereturnorderline_id'] = '';
$data['purchasereturndeliveryline__lastupdate'] = '';
$data['purchasereturndeliveryline__updatedby'] = '';
$data['purchasereturndeliveryline__created'] = '';
$data['purchasereturndeliveryline__createdby'] = '';
		

		$this->load->view('purchase_return_delivery_line_view_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['purchasereturndeliveryline__item_id']) || ($_POST['purchasereturndeliveryline__item_id'] == "" || $_POST['purchasereturndeliveryline__item_id'] == null  || $_POST['purchasereturndeliveryline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['purchasereturndeliveryline__quantitytosend']) && ($_POST['purchasereturndeliveryline__quantitytosend'] == "" || $_POST['purchasereturndeliveryline__quantitytosend'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['purchasereturndeliveryline__uom_id']) || ($_POST['purchasereturndeliveryline__uom_id'] == "" || $_POST['purchasereturndeliveryline__uom_id'] == null  || $_POST['purchasereturndeliveryline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['purchasereturndelivery_id'] = $_POST['purchasereturndelivery_id'];if (isset($_POST['purchasereturndeliveryline__item_id']))
$data['item_id'] = $_POST['purchasereturndeliveryline__item_id'];if (isset($_POST['purchasereturndeliveryline__quantitytosend']))
$data['quantitytosend'] = $_POST['purchasereturndeliveryline__quantitytosend'];if (isset($_POST['purchasereturndeliveryline__uom_id']))
$data['uom_id'] = $_POST['purchasereturndeliveryline__uom_id'];if (isset($_POST['purchasereturndeliveryline__purchasereturnorderline_id']))
$data['purchasereturnorderline_id'] = $_POST['purchasereturndeliveryline__purchasereturnorderline_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturndeliveryline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturndeliveryline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_delivery_line_viewadd','purchasereturndeliveryline','aftersave', $purchasereturndeliveryline_id);
			
		
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