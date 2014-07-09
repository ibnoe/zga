<?php

class receive_items_line_viewedit extends Controller {

	function receive_items_line_viewedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($receive_items_line_view_id=0)
	{
		if ($receive_items_line_view_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $receive_items_line_view_id);
$this->db->select('*');
$this->db->select('DATE_FORMAT(expireddate, "%d-%m-%Y") as expireddate', false);
$q = $this->db->get('receiveditemline');
if ($q->num_rows() > 0) {
$data = array();
$data['receive_items_line_view_id'] = $receive_items_line_view_id;
foreach ($q->result() as $r) {
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['receiveditemline__item_id'] = $r->item_id;
$data['receiveditemline__quantitytoreceive'] = $r->quantitytoreceive;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['receiveditemline__uom_id'] = $r->uom_id;
$data['receiveditemline__purchaseorderline_id'] = $r->purchaseorderline_id;
$data['receiveditemline__serialno'] = $r->serialno;
$data['receiveditemline__expireddate'] = $r->expireddate;
$data['receiveditemline__hscode'] = $r->hscode;
$data['receiveditemline__packinglist'] = $r->packinglist;
$data['receiveditemline__lastupdate'] = $r->lastupdate;
$data['receiveditemline__updatedby'] = $r->updatedby;
$data['receiveditemline__created'] = $r->created;
$data['receiveditemline__createdby'] = $r->createdby;}
$this->load->view('receive_items_line_view_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['receiveditemline__item_id']) || ($_POST['receiveditemline__item_id'] == "" || $_POST['receiveditemline__item_id'] == null  || $_POST['receiveditemline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['receiveditemline__quantitytoreceive']) && ($_POST['receiveditemline__quantitytoreceive'] == "" || $_POST['receiveditemline__quantitytoreceive'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['receiveditemline__uom_id']) || ($_POST['receiveditemline__uom_id'] == "" || $_POST['receiveditemline__uom_id'] == null  || $_POST['receiveditemline__uom_id'] == 0))
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
$this->db->where('id', $_POST['receive_items_line_view_id']);
$this->db->update('receiveditemline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('receive_items_line_viewedit','receiveditemline','afteredit', $_POST['receive_items_line_view_id']);
			
			
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