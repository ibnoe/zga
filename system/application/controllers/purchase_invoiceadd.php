<?php

class purchase_invoiceadd extends Controller {

	function purchase_invoiceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchaseinvoice__date'] = '';
$data['purchaseinvoice__orderid'] = '';$this->load->library('generallib');
$data['purchaseinvoice__orderid'] = $this->generallib->genId('Purchase Invoice');
$receiveditem_opt = array();
$receiveditem_opt[''] = 'None';
$q = $this->db->get('receiveditem');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $receiveditem_opt[$row->id] = $row->suratjalanno; }
$data['receiveditem_opt'] = $receiveditem_opt;
$data['purchaseinvoice__receiveditem_id'] = '';
$data['purchaseinvoice__supplier_id'] = '';
$data['purchaseinvoice__currency_id'] = '';
$data['purchaseinvoice__currencyrate'] = '';
$data['purchaseinvoice__total'] = '';
$data['purchaseinvoice__top'] = '';
$ongkoskirimimport_opt = array();
$ongkoskirimimport_opt[''] = 'None';
$q = $this->db->get('ongkoskirimimport');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $ongkoskirimimport_opt[$row->id] = $row->idstring; }
$data['ongkoskirimimport_opt'] = $ongkoskirimimport_opt;
$data['purchaseinvoice__ongkoskirimimport_id'] = '';
$data['purchaseinvoice__lastupdate'] = '';
$data['purchaseinvoice__updatedby'] = '';
$data['purchaseinvoice__created'] = '';
$data['purchaseinvoice__createdby'] = '';
		

		$this->load->view('purchase_invoice_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchaseinvoice__date']) && ($_POST['purchaseinvoice__date'] == "" || $_POST['purchaseinvoice__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchaseinvoice__orderid']) && ($_POST['purchaseinvoice__orderid'] == "" || $_POST['purchaseinvoice__orderid'] == null))
$error .= "<span class='error'>Purchase Invoice No must not be empty"."</span><br>";

if (isset($_POST['purchaseinvoice__orderid'])) {
$this->db->where('orderid', $_POST['purchaseinvoice__orderid']);
$q = $this->db->get('purchaseinvoice');
if ($q->num_rows() > 0) $error .= "<span class='error'>Purchase Invoice No must be unique"."</span><br>";}

if (!isset($_POST['purchaseinvoice__receiveditem_id']) || ($_POST['purchaseinvoice__receiveditem_id'] == "" || $_POST['purchaseinvoice__receiveditem_id'] == null  || $_POST['purchaseinvoice__receiveditem_id'] == null))
$error .= "<span class='error'>Receive Items must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchaseinvoice__date']))
$this->db->set('date', "str_to_date('".$_POST['purchaseinvoice__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchaseinvoice__orderid']))
$data['orderid'] = $_POST['purchaseinvoice__orderid'];if (isset($_POST['purchaseinvoice__receiveditem_id']))
$data['receiveditem_id'] = $_POST['purchaseinvoice__receiveditem_id'];if (isset($_POST['purchaseinvoice__supplier_id']))
$data['supplier_id'] = $_POST['purchaseinvoice__supplier_id'];if (isset($_POST['purchaseinvoice__currency_id']))
$data['currency_id'] = $_POST['purchaseinvoice__currency_id'];if (isset($_POST['purchaseinvoice__currencyrate']))
$data['currencyrate'] = $_POST['purchaseinvoice__currencyrate'];if (isset($_POST['purchaseinvoice__total']))
$data['total'] = $_POST['purchaseinvoice__total'];if (isset($_POST['purchaseinvoice__top']))
$data['top'] = $_POST['purchaseinvoice__top'];if (isset($_POST['purchaseinvoice__ongkoskirimimport_id']))
$data['ongkoskirimimport_id'] = $_POST['purchaseinvoice__ongkoskirimimport_id'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchaseinvoice', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchaseinvoice_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_invoiceadd','purchaseinvoice','aftersave', $purchaseinvoice_id);
			
		
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