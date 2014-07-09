<?php

class penawaran_lineadd extends Controller {

	function penawaran_lineadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		$data['salesorderquote_id'] = $id;
$data['salesorderquoteline__orderid'] = '';
$data['salesorderquoteline__date'] = '';
$data['salesorderquoteline__notes'] = '';
$data['salesorderquoteline__customer_id'] = '';
$data['salesorderquoteline__currency_id'] = '';
$data['salesorderquoteline__currencyrate'] = '';
$data['salesorderquoteline__warehouse_id'] = '';
$data['salesorderquoteline__status'] = '';
$data['salesorderquoteline__type'] = '';
$item_opt = array();
$item_opt[''] = 'None';
$q = $this->db->get('item');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $item_opt[$row->id] = $row->name; }
$data['item_opt'] = $item_opt;
$data['salesorderquoteline__item_id'] = '';
$data['salesorderquoteline__quantity'] = '';
$uom_opt = array();
$uom_opt[''] = 'None';
$q = $this->db->get('uom');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $uom_opt[$row->id] = $row->name; }
$data['uom_opt'] = $uom_opt;
$data['salesorderquoteline__uom_id'] = '';
$data['salesorderquoteline__price'] = '';
$data['salesorderquoteline__pdisc'] = '';
$data['salesorderquoteline__modulename'] = 'penawaran_line';
$data['salesorderquoteline__subtotal'] = '';
$data['salesorderquoteline__lastupdate'] = '';
$data['salesorderquoteline__updatedby'] = '';
$data['salesorderquoteline__created'] = '';
$data['salesorderquoteline__createdby'] = '';
$salesorderquote = array();
$this->db->where('id', $id);
$q = $this->db->get('salesorderquote');
if ($q->num_rows() > 0)
$salesorderquote = $q->row_array();
$data['salesorderquoteline__orderid'] = $salesorderquote['orderid'];
$data['salesorderquoteline__date'] = $salesorderquote['date'];
$data['salesorderquoteline__notes'] = $salesorderquote['notes'];
$data['salesorderquoteline__customer_id'] = $salesorderquote['customer_id'];
$data['salesorderquoteline__currency_id'] = $salesorderquote['currency_id'];
$data['salesorderquoteline__currencyrate'] = $salesorderquote['currencyrate'];
$data['salesorderquoteline__status'] = $salesorderquote['status'];
$data['salesorderquoteline__lastupdate'] = $salesorderquote['lastupdate'];
$data['salesorderquoteline__updatedby'] = $salesorderquote['updatedby'];
$data['salesorderquoteline__created'] = $salesorderquote['created'];
$data['salesorderquoteline__createdby'] = $salesorderquote['createdby'];
		

		$this->load->view('penawaran_line_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (!isset($_POST['salesorderquoteline__item_id']) || ($_POST['salesorderquoteline__item_id'] == "" || $_POST['salesorderquoteline__item_id'] == null  || $_POST['salesorderquoteline__item_id'] == null))
$error .= "<span class='error'>Item must not be empty"."</span><br>";

if (isset($_POST['salesorderquoteline__quantity']) && ($_POST['salesorderquoteline__quantity'] == "" || $_POST['salesorderquoteline__quantity'] == null))
$error .= "<span class='error'>Quantity must not be empty"."</span><br>";

if (!isset($_POST['salesorderquoteline__uom_id']) || ($_POST['salesorderquoteline__uom_id'] == "" || $_POST['salesorderquoteline__uom_id'] == null  || $_POST['salesorderquoteline__uom_id'] == null))
$error .= "<span class='error'>Unit must not be empty"."</span><br>";

if (isset($_POST['salesorderquoteline__price']) && ($_POST['salesorderquoteline__price'] == "" || $_POST['salesorderquoteline__price'] == null))
$error .= "<span class='error'>Price must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();
$data['salesorderquote_id'] = $_POST['salesorderquote_id'];if (isset($_POST['salesorderquoteline__orderid']))
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
$data['pdisc'] = $_POST['salesorderquoteline__pdisc'];if (isset($_POST['salesorderquoteline__modulename']))
$data['modulename'] = $_POST['salesorderquoteline__modulename'];if (isset($_POST['salesorderquoteline__subtotal']))
$data['subtotal'] = $_POST['salesorderquoteline__subtotal'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesorderquoteline', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesorderquoteline_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('penawaran_lineadd','salesorderquoteline','aftersave', $salesorderquoteline_id);
			
		
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