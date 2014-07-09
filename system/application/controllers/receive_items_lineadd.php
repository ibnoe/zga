<?php

class receive_items_lineadd extends Controller {

	function receive_items_lineadd()
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
$data['receiveditemline__item_id'] = '';
$data['receiveditemline__quantitytoreceive'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['receiveditemline__uom_id'] = '';
$purchaseorderline_opt = array();
$purchaseorderline_opt[''] = 'None';
$q = $this->db->get('purchaseorderline');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchaseorderline_opt[$row->id] = $row->orderid; }
$data['purchaseorderline_opt'] = $purchaseorderline_opt;
$data['receiveditemline__purchaseorderline_id'] = '';
$data['receiveditemline__serialno'] = '';
$data['receiveditemline__expireddate'] = '';
$data['receiveditemline__hscode'] = '';
$data['receiveditemline__packinglist'] = '';
$data['receiveditemline__lastupdate'] = '';
$data['receiveditemline__updatedby'] = '';
$data['receiveditemline__created'] = '';
$data['receiveditemline__createdby'] = '';
		

		$this->load->view('receive_items_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['receiveditemline__item_id']) || ($_POST['receiveditemline__item_id'] == "" || $_POST['receiveditemline__item_id'] == null  || $_POST['receiveditemline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['receiveditemline__quantitytoreceive']) && ($_POST['receiveditemline__quantitytoreceive'] == "" || $_POST['receiveditemline__quantitytoreceive'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['receiveditemline__uom_id']) || ($_POST['receiveditemline__uom_id'] == "" || $_POST['receiveditemline__uom_id'] == null  || $_POST['receiveditemline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['receiveditemline__expireddate']) && ($_POST['receiveditemline__expireddate'] == "" || $_POST['receiveditemline__expireddate'] == null))
$error .= "<span class='error'>Expired Date must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['receiveditemline__item_id']))
$data['item_id'] = $_POST['receiveditemline__item_id'];if (isset($_POST['receiveditemline__quantitytoreceive']))
$data['quantitytoreceive'] = $_POST['receiveditemline__quantitytoreceive'];if (isset($_POST['receiveditemline__uom_id']))
$data['uom_id'] = $_POST['receiveditemline__uom_id'];if (isset($_POST['receiveditemline__purchaseorderline_id']))
$data['purchaseorderline_id'] = $_POST['receiveditemline__purchaseorderline_id'];if (isset($_POST['receiveditemline__serialno']))
$data['serialno'] = $_POST['receiveditemline__serialno'];if (isset($_POST['receiveditemline__expireddate']))
$this->db->set('expireddate', "str_to_date('".$_POST['receiveditemline__expireddate']."', '%d-%m-%Y')", false);if (isset($_POST['receiveditemline__hscode']))
$data['hscode'] = $_POST['receiveditemline__hscode'];if (isset($_POST['receiveditemline__packinglist']))
$data['packinglist'] = $_POST['receiveditemline__packinglist'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('receiveditemline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$receiveditemline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('receive_items_lineadd','receiveditemline','aftersave', $receiveditemline_id);
			
		
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