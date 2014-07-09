<?php

class purchase_return_invoiceadd extends Controller {

	function purchase_return_invoiceadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasereturninvoice__date'] = '';
$data['purchasereturninvoice__purchasereturninvoiceid'] = '';$this->load->library('generallib');
$data['purchasereturninvoice__purchasereturninvoiceid'] = $this->generallib->genId('Purchase Return Invoice');
$purchasereturndelivery_opt = array();
$purchasereturndelivery_opt[''] = 'None';
$q = $this->db->get('purchasereturndelivery');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchasereturndelivery_opt[$row->id] = $row->purchasereturndeliveryid; }
$data['purchasereturndelivery_opt'] = $purchasereturndelivery_opt;
$data['purchasereturninvoice__purchasereturndelivery_id'] = '';
$data['purchasereturninvoice__supplier_id'] = '';
$data['purchasereturninvoice__currency_id'] = '';
$data['purchasereturninvoice__currencyrate'] = '';
$data['purchasereturninvoice__total'] = '';
$data['purchasereturninvoice__lastupdate'] = '';
$data['purchasereturninvoice__updatedby'] = '';
$data['purchasereturninvoice__created'] = '';
$data['purchasereturninvoice__createdby'] = '';
		

		$this->load->view('purchase_return_invoice_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchasereturninvoice__date']) && ($_POST['purchasereturninvoice__date'] == "" || $_POST['purchasereturninvoice__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturninvoice__purchasereturninvoiceid']) && ($_POST['purchasereturninvoice__purchasereturninvoiceid'] == "" || $_POST['purchasereturninvoice__purchasereturninvoiceid'] == null))
$error .= "<span class='error'>Invoice No must not be empty"."</span><br>";

if (isset($_POST['purchasereturninvoice__purchasereturninvoiceid'])) {
$this->db->where('purchasereturninvoiceid', $_POST['purchasereturninvoice__purchasereturninvoiceid']);
$q = $this->db->get('purchasereturninvoice');
if ($q->num_rows() > 0) $error .= "<span class='error'>Invoice No must be unique"."</span><br>";}

if (!isset($_POST['purchasereturninvoice__purchasereturndelivery_id']) || ($_POST['purchasereturninvoice__purchasereturndelivery_id'] == "" || $_POST['purchasereturninvoice__purchasereturndelivery_id'] == null  || $_POST['purchasereturninvoice__purchasereturndelivery_id'] == null))
$error .= "<span class='error'>Purchase Return Delivery must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturninvoice__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasereturninvoice__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasereturninvoice__purchasereturninvoiceid']))
$data['purchasereturninvoiceid'] = $_POST['purchasereturninvoice__purchasereturninvoiceid'];if (isset($_POST['purchasereturninvoice__purchasereturndelivery_id']))
$data['purchasereturndelivery_id'] = $_POST['purchasereturninvoice__purchasereturndelivery_id'];if (isset($_POST['purchasereturninvoice__supplier_id']))
$data['supplier_id'] = $_POST['purchasereturninvoice__supplier_id'];if (isset($_POST['purchasereturninvoice__currency_id']))
$data['currency_id'] = $_POST['purchasereturninvoice__currency_id'];if (isset($_POST['purchasereturninvoice__currencyrate']))
$data['currencyrate'] = $_POST['purchasereturninvoice__currencyrate'];if (isset($_POST['purchasereturninvoice__total']))
$data['total'] = $_POST['purchasereturninvoice__total'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturninvoice', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturninvoice_id = $this->db->insert_id();
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_invoiceadd','purchasereturninvoice','aftersave', $purchasereturninvoice_id);
			
		
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