<?php

class open_purchase_orderedit extends Controller {

	function open_purchase_orderedit()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($open_purchase_order_id=0)
	{
		
$q = $this->db->where('id', $open_purchase_order_id);
$q = $this->db->get('porder');
if ($q->num_rows() > 0) {
$data = array();
$data['open_purchase_order_id'] = $open_purchase_order_id;
foreach ($q->result() as $r) {
$data['porder__orderid'] = $r->orderid;
$data['porder__date'] = $r->date;
$data['porder__notes'] = $r->notes;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__contact_id'] = $r->contact_id;
$currency_opt = array();
$q = $this->db->get('currency');
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['porder__currency_id'] = $r->currency_id;
$data['porder__currencyrate'] = $r->currencyrate;
$contact_opt = array();
$q = $this->db->get('contact');
foreach ($q->result() as $row) { $contact_opt[$row->id] = $row->firstname; }
$data['contact_opt'] = $contact_opt;
$data['porder__to_id'] = $r->to_id;
$data['porder__taxable'] = $r->taxable;
$data['porder__taxincluded'] = $r->taxincluded;
$data['porder__'] = $r->;}
$this->load->view('open_purchase_order_edit_form', $data);
}
		

		
		
	}
	
	function submit()
	{
		$error = "";

		
if (isset($_POST['porder__orderid'])) {$this->db->where("id !=", $_POST['open_purchase_order_id']);
$this->db->where('orderid', $_POST['porder__orderid']);
$q = $this->db->get('porder');
if ($q->num_rows() > 0) $error .= "<span class='error'>Order ID must be unique"."</span><br>";}

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['porder__orderid']))
$data['orderid'] = $_POST['porder__orderid'];if (isset($_POST['porder__date']))
$data['date'] = $_POST['porder__date'];if (isset($_POST['porder__notes']))
$data['notes'] = $_POST['porder__notes'];if (isset($_POST['porder__contact_id']))
$data['contact_id'] = $_POST['porder__contact_id'];if (isset($_POST['porder__currency_id']))
$data['currency_id'] = $_POST['porder__currency_id'];if (isset($_POST['porder__currencyrate']))
$data['currencyrate'] = $_POST['porder__currencyrate'];if (isset($_POST['porder__to_id']))
$data['to_id'] = $_POST['porder__to_id'];if (isset($_POST['porder__taxable']))
$data['taxable'] = $_POST['porder__taxable'];if (isset($_POST['porder__taxincluded']))
$data['taxincluded'] = $_POST['porder__taxincluded'];if (isset($_POST['porder__']))
$data[''] = $_POST['porder__'];
$this->db->where('id', $_POST['open_purchase_order_id']);
$this->db->update('porder', $data);
			
			
			
			echo "<span style='background-color:green'>   </span> "."record successfully updated.";
		}
		else
		{
			echo "<span style='background-color:red'>   </span> ".$error;
		}
	}
}

?>