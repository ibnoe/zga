<?php

class purchase_order_quote_lineadd extends Controller {

	function purchase_order_quote_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['purchaseorderquote_id'] = $id;
$data['purchaseorderquoteline__orderid'] = '';
$data['purchaseorderquoteline__date'] = '';
$data['purchaseorderquoteline__notes'] = '';
$data['purchaseorderquoteline__supplier_id'] = '';
$data['purchaseorderquoteline__currency_id'] = '';
$data['purchaseorderquoteline__currencyrate'] = '';
$data['purchaseorderquoteline__warehouse_id'] = '';
$item_opt = array();
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['purchaseorderquoteline__item_id'] = '';
$data['purchaseorderquoteline__quantity'] = '';
$uom_opt = array();
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['purchaseorderquoteline__uom_id'] = '';
$data['purchaseorderquoteline__price'] = '';
$data['purchaseorderquoteline__subtotal'] = '';
$data['purchaseorderquoteline__lastupdate'] = '';
$data['purchaseorderquoteline__updatedby'] = '';
$purchaseorderquote = array();
$this->db->where('id', $id);
$q = $this->db->get('purchaseorderquote');
if ($q->num_rows() > 0)
$purchaseorderquote = $q->row_array();
$data['purchaseorderquoteline__orderid'] = $purchaseorderquote['orderid'];
$data['purchaseorderquoteline__date'] = $purchaseorderquote['date'];
$data['purchaseorderquoteline__notes'] = $purchaseorderquote['notes'];
$data['purchaseorderquoteline__supplier_id'] = $purchaseorderquote['supplier_id'];
$data['purchaseorderquoteline__currency_id'] = $purchaseorderquote['currency_id'];
$data['purchaseorderquoteline__currencyrate'] = $purchaseorderquote['currencyrate'];
$data['purchaseorderquoteline__warehouse_id'] = $purchaseorderquote['warehouse_id'];
$data['purchaseorderquoteline__lastupdate'] = $purchaseorderquote['lastupdate'];
$data['purchaseorderquoteline__updatedby'] = $purchaseorderquote['updatedby'];
		

		$this->load->view('purchase_order_quote_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchaseorderquoteline__item_id']) && ($_POST['purchaseorderquoteline__item_id'] == "" || $_POST['purchaseorderquoteline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['purchaseorderquoteline__quantity']) && ($_POST['purchaseorderquoteline__quantity'] == "" || $_POST['purchaseorderquoteline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (isset($_POST['purchaseorderquoteline__uom_id']) && ($_POST['purchaseorderquoteline__uom_id'] == "" || $_POST['purchaseorderquoteline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['purchaseorderquoteline__price']) && ($_POST['purchaseorderquoteline__price'] == "" || $_POST['purchaseorderquoteline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_order_quote_lineadd','purchaseorderquoteline','validation', 0, $_POST);
		
		if ($error == "")
		{
			
$data = array();
$data['purchaseorderquote_id'] = $_POST['purchaseorderquote_id'];if (isset($_POST['purchaseorderquoteline__orderid']))
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
$this->db->insert('purchaseorderquoteline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchaseorderquoteline_id = $this->db->insert_id();
$this->load->library('generallib');
$this->generallib->commonfunction('purchase_order_quote_lineadd','purchaseorderquoteline','aftersave', $purchaseorderquoteline_id);
	
			
			echo "<span style='background-color:green'>   </span> "."record successfully inserted.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>