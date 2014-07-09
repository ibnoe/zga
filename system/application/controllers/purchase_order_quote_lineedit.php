<?php

class purchase_order_quote_lineedit extends Controller {

	function purchase_order_quote_lineedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($purchase_order_quote_line_id=0)
	{
		if ($purchase_order_quote_line_id == 0)
		{
			redirect(current_url()."/".$this->session->userdata('last_insert_id'));
			return;
		}
	
		
$q = $this->db->where('id', $purchase_order_quote_line_id);
$q = $this->db->get('purchaseorderquoteline');
if ($q->num_rows() > 0) {
$data = array();
$data['purchase_order_quote_line_id'] = $purchase_order_quote_line_id;
foreach ($q->result() as $r) {
$data['purchaseorderquoteline__orderid'] = $r->orderid;
$data['purchaseorderquoteline__date'] = $r->date;
$data['purchaseorderquoteline__notes'] = $r->notes;
$data['purchaseorderquoteline__supplier_id'] = $r->supplier_id;
$data['purchaseorderquoteline__currency_id'] = $r->currency_id;
$data['purchaseorderquoteline__currencyrate'] = $r->currencyrate;
$data['purchaseorderquoteline__warehouse_id'] = $r->warehouse_id;
$item_opt = array();
$q = $this->db->get('item');
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseorderquoteline__item_id'] = $r->item_id;
$data['purchaseorderquoteline__quantity'] = $r->quantity;
$uom_opt = array();
$q = $this->db->get('uom');
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseorderquoteline__uom_id'] = $r->uom_id;
$data['purchaseorderquoteline__price'] = $r->price;
$data['purchaseorderquoteline__subtotal'] = $r->subtotal;
$data['purchaseorderquoteline__lastupdate'] = $r->lastupdate;
$data['purchaseorderquoteline__updatedby'] = $r->updatedby;}
$this->load->view('purchase_order_quote_line_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchaseorderquoteline__orderid']))
$data['orderid'] = $_POST['purchaseorderquoteline__orderid'];if (isset($_POST['purchaseorderquoteline__date']))
$data['date'] = $_POST['purchaseorderquoteline__date'];if (isset($_POST['purchaseorderquoteline__notes']))
$data['notes'] = $_POST['purchaseorderquoteline__notes'];if (isset($_POST['purchaseorderquoteline__supplier_id']))
$data['supplier_id'] = $_POST['purchaseorderquoteline__supplier_id'];if (isset($_POST['purchaseorderquoteline__currency_id']))
$data['currency_id'] = $_POST['purchaseorderquoteline__currency_id'];if (isset($_POST['purchaseorderquoteline__currencyrate']))
$data['currencyrate'] = $_POST['purchaseorderquoteline__currencyrate'];if (isset($_POST['purchaseorderquoteline__warehouse_id']))
$data['warehouse_id'] = $_POST['purchaseorderquoteline__warehouse_id'];if (isset($_POST['purchaseorderquoteline__item_id']))
$data['item_id'] = $_POST['purchaseorderquoteline__item_id'];if (isset($_POST['purchaseorderquoteline__quantity']))
$data['quantity'] = $_POST['purchaseorderquoteline__quantity'];if (isset($_POST['purchaseorderquoteline__uom_id']))
$data['uom_id'] = $_POST['purchaseorderquoteline__uom_id'];if (isset($_POST['purchaseorderquoteline__price']))
$data['price'] = $_POST['purchaseorderquoteline__price'];if (isset($_POST['purchaseorderquoteline__subtotal']))
$data['subtotal'] = $_POST['purchaseorderquoteline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$this->db->where('id', $_POST['purchase_order_quote_line_id']);
$this->db->update('purchaseorderquoteline', $data);
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_order_quote_lineedit','purchaseorderquoteline','aftersave');
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>