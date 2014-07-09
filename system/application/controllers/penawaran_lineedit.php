<?php

class penawaran_lineedit extends Controller {

	function penawaran_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($penawaran_line_id=0)
	{
		if ($penawaran_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $penawaran_line_id);
$this->db->select('*');
$q = $this->db->get('salesorderquoteline');
if ($q->num_rows() > 0) {
$data = array();
$data['penawaran_line_id'] = $penawaran_line_id;
foreach ($q->result() as $r) {
$data['salesorderquoteline__orderid'] = $r->orderid;
$data['salesorderquoteline__date'] = $r->date;
$data['salesorderquoteline__notes'] = $r->notes;
$data['salesorderquoteline__customer_id'] = $r->customer_id;
$data['salesorderquoteline__currency_id'] = $r->currency_id;
$data['salesorderquoteline__currencyrate'] = $r->currencyrate;
$data['salesorderquoteline__warehouse_id'] = $r->warehouse_id;
$data['salesorderquoteline__status'] = $r->status;
$data['salesorderquoteline__type'] = $r->type;
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesorderquoteline__item_id'] = $r->item_id;
$data['salesorderquoteline__quantity'] = $r->quantity;
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesorderquoteline__uom_id'] = $r->uom_id;
$data['salesorderquoteline__price'] = $r->price;
$data['salesorderquoteline__pdisc'] = $r->pdisc;
$data['salesorderquoteline__subtotal'] = $r->subtotal;
$data['salesorderquoteline__modulename'] = $r->modulename;
$data['salesorderquoteline__lastupdate'] = $r->lastupdate;
$data['salesorderquoteline__updatedby'] = $r->updatedby;
$data['salesorderquoteline__created'] = $r->created;
$data['salesorderquoteline__createdby'] = $r->createdby;}
$this->load->view('penawaran_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (!isset($_POST['salesorderquoteline__item_id']) || ($_POST['salesorderquoteline__item_id'] == "" || $_POST['salesorderquoteline__item_id'] == null  || $_POST['salesorderquoteline__item_id'] == 0))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['salesorderquoteline__quantity']) && ($_POST['salesorderquoteline__quantity'] == "" || $_POST['salesorderquoteline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesorderquoteline__uom_id']) || ($_POST['salesorderquoteline__uom_id'] == "" || $_POST['salesorderquoteline__uom_id'] == null  || $_POST['salesorderquoteline__uom_id'] == 0))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['salesorderquoteline__price']) && ($_POST['salesorderquoteline__price'] == "" || $_POST['salesorderquoteline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesorderquoteline__orderid']))
$data['orderid'] = $_POST['salesorderquoteline__orderid'];if (isset($_POST['salesorderquoteline__date']))
$data['date'] = $_POST['salesorderquoteline__date'];if (isset($_POST['salesorderquoteline__notes']))
$data['notes'] = $_POST['salesorderquoteline__notes'];if (isset($_POST['salesorderquoteline__customer_id']))
$data['customer_id'] = $_POST['salesorderquoteline__customer_id'];if (isset($_POST['salesorderquoteline__currency_id']))
$data['currency_id'] = $_POST['salesorderquoteline__currency_id'];if (isset($_POST['salesorderquoteline__currencyrate']))
$data['currencyrate'] = $_POST['salesorderquoteline__currencyrate'];if (isset($_POST['salesorderquoteline__warehouse_id']))
$data['warehouse_id'] = $_POST['salesorderquoteline__warehouse_id'];if (isset($_POST['salesorderquoteline__status']))
$data['status'] = $_POST['salesorderquoteline__status'];if (isset($_POST['salesorderquoteline__type']))
$data['type'] = $_POST['salesorderquoteline__type'];if (isset($_POST['salesorderquoteline__item_id']))
$data['item_id'] = $_POST['salesorderquoteline__item_id'];if (isset($_POST['salesorderquoteline__quantity']))
$data['quantity'] = $_POST['salesorderquoteline__quantity'];if (isset($_POST['salesorderquoteline__uom_id']))
$data['uom_id'] = $_POST['salesorderquoteline__uom_id'];if (isset($_POST['salesorderquoteline__price']))
$data['price'] = $_POST['salesorderquoteline__price'];if (isset($_POST['salesorderquoteline__pdisc']))
$data['pdisc'] = $_POST['salesorderquoteline__pdisc'];if (isset($_POST['salesorderquoteline__subtotal']))
$data['subtotal'] = $_POST['salesorderquoteline__subtotal'];if (isset($_POST['salesorderquoteline__modulename']))
$data['modulename'] = $_POST['salesorderquoteline__modulename'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['penawaran_line_id']);
$this->db->update('salesorderquoteline', $data);
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('penawaran_lineedit','salesorderquoteline','afteredit', $_POST['penawaran_line_id']);
			
			
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