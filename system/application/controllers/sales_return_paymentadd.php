<?php

class sales_return_paymentadd extends Controller {

	function sales_return_paymentadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salesreturnpayment__date'] = '';
$data['salesreturnpayment__salesreturnpaymentid'] = '';$this->load->library('generallib');
$data['salesreturnpayment__salesreturnpaymentid'] = $this->generallib->genId('Sales Return Payment');
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salesreturnpayment__customer_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salesreturnpayment__currency_id'] = '';
$data['salesreturnpayment__currencyrate'] = '';
$data['salesreturnpayment__paymenttype'] = '';
$cashbank_opt = array();
$cashbank_opt[''] = 'None';
$q = $this->db->get('cashbank');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['salesreturnpayment__cashbank_id'] = '';
$giroout_opt = array();
$giroout_opt[''] = 'None';
$q = $this->db->get('giroout');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['salesreturnpayment__giroout_id'] = '';
$creditnoteout_opt = array();
$creditnoteout_opt[''] = 'None';
$q = $this->db->get('creditnoteout');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $creditnoteout_opt[$row->id] = $row->creditnoteoutid; }
$data['creditnoteout_opt'] = $creditnoteout_opt;
$data['salesreturnpayment__creditnoteout_id'] = '';$this->load->library('generallib');
$data['salesreturnpayment__creditnoteout_id'] = $this->generallib->genId('Sales Return Payment');
$data['salesreturnpayment__total'] = '';
$data['salesreturnpayment__totalpay'] = '';
$data['salesreturnpayment__adjustment'] = '';
$data['salesreturnpayment__lastupdate'] = '';
$data['salesreturnpayment__updatedby'] = '';
$data['salesreturnpayment__created'] = '';
$data['salesreturnpayment__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['salesreturnpayment__date'] = $_POST['date'];}if (isset($_POST['salesreturnpaymentid']) && $_POST['salesreturnpaymentid'] != -1){$data['salesreturnpayment__salesreturnpaymentid'] = $_POST['salesreturnpaymentid'];}if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1){$data['salesreturnpayment__customer_id'] = $_POST['customer_id'];}if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1){$data['salesreturnpayment__currency_id'] = $_POST['currency_id'];}if (isset($_POST['currencyrate']) && $_POST['currencyrate'] != -1){$data['salesreturnpayment__currencyrate'] = $_POST['currencyrate'];}if (isset($_POST['paymenttype']) && $_POST['paymenttype'] != -1){$data['salesreturnpayment__paymenttype'] = $_POST['paymenttype'];}if (isset($_POST['cashbank_id']) && $_POST['cashbank_id'] != -1){$data['salesreturnpayment__cashbank_id'] = $_POST['cashbank_id'];}if (isset($_POST['giroout_id']) && $_POST['giroout_id'] != -1){$data['salesreturnpayment__giroout_id'] = $_POST['giroout_id'];}if (isset($_POST['creditnoteout_id']) && $_POST['creditnoteout_id'] != -1){$data['salesreturnpayment__creditnoteout_id'] = $_POST['creditnoteout_id'];}if (isset($_POST['total']) && $_POST['total'] != -1){$data['salesreturnpayment__total'] = $_POST['total'];}if (isset($_POST['totalpay']) && $_POST['totalpay'] != -1){$data['salesreturnpayment__totalpay'] = $_POST['totalpay'];}if (isset($_POST['adjustment']) && $_POST['adjustment'] != -1){$data['salesreturnpayment__adjustment'] = $_POST['adjustment'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['salesreturnpayment__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['salesreturnpayment__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['salesreturnpayment__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['salesreturnpayment__createdby'] = $_POST['createdby'];}
if (!isset($_POST['salesreturninvoice__id'])) { echo 'You must at least tick one option'; return; }
$salesreturninvoice_ids = $_POST['salesreturninvoice__id'];
$linedata = array();
foreach ($salesreturninvoice_ids as $salesreturninvoice_id)
{
$this->db->where('id', $salesreturninvoice_id);
$qq = $this->db->get('salesreturninvoice');
if (isset($qq->row()->customer_id)) {
if ($data['salesreturnpayment__customer_id'] > 0 && $data['salesreturnpayment__customer_id'] != $qq->row()->customer_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturnpayment__customer_id'] = $qq->row()->customer_id;
}
if (isset($qq->row()->currency_id)) {
if ($data['salesreturnpayment__currency_id'] > 0 && $data['salesreturnpayment__currency_id'] != $qq->row()->currency_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturnpayment__currency_id'] = $qq->row()->currency_id;
}
if (isset($qq->row()->cashbank_id)) {
if ($data['salesreturnpayment__cashbank_id'] > 0 && $data['salesreturnpayment__cashbank_id'] != $qq->row()->cashbank_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturnpayment__cashbank_id'] = $qq->row()->cashbank_id;
}
if (isset($qq->row()->giroout_id)) {
if ($data['salesreturnpayment__giroout_id'] > 0 && $data['salesreturnpayment__giroout_id'] != $qq->row()->giroout_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturnpayment__giroout_id'] = $qq->row()->giroout_id;
}
if (isset($qq->row()->creditnoteout_id)) {
if ($data['salesreturnpayment__creditnoteout_id'] > 0 && $data['salesreturnpayment__creditnoteout_id'] != $qq->row()->creditnoteout_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salesreturnpayment__creditnoteout_id'] = $qq->row()->creditnoteout_id;
}
if (isset($qq->row()->salesreturninvoice_id))
$linedata['salesreturnpaymentline__salesreturninvoice_id'] = $qq->row()->salesreturninvoice_id;
else
$linedata['salesreturnpaymentline__salesreturninvoice_id'] = null;
$salesreturninvoice_opt = array();
$salesreturninvoice_opt[''] = 'None';
$q = $this->db->get('salesreturninvoice');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesreturninvoice_opt[$row->id] = $row->salesreturninvoiceid; }
$data['salesreturninvoice_opt'] = $salesreturninvoice_opt;
if (isset($qq->row()->lastupdate))
$linedata['salesreturnpaymentline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['salesreturnpaymentline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['salesreturnpaymentline__updatedby'] = $qq->row()->updatedby;
else
$linedata['salesreturnpaymentline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['salesreturnpaymentline__created'] = $qq->row()->created;
else
$linedata['salesreturnpaymentline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['salesreturnpaymentline__createdby'] = $qq->row()->createdby;
else
$linedata['salesreturnpaymentline__createdby'] = null;
$linedata['salesreturnpaymentline__salesreturninvoice_id'] = $salesreturninvoice_id;
$data['salesreturnpaymentline_data'][$salesreturninvoice_id] = $linedata;
}
$sum = 0; foreach($_POST['salesreturninvoice__id'] as $tid){ $this->db->where('id', $tid);$q = $this->db->get('salesreturninvoice'); $sum += $q->row()->total; }
$data['salesreturnpayment__total'] = $sum;
		

		$this->load->view('sales_return_payment_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salesreturnpayment__date']) && ($_POST['salesreturnpayment__date'] == "" || $_POST['salesreturnpayment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salesreturnpayment__salesreturnpaymentid']) && ($_POST['salesreturnpayment__salesreturnpaymentid'] == "" || $_POST['salesreturnpayment__salesreturnpaymentid'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['salesreturnpayment__salesreturnpaymentid'])) {
$this->db->where('salesreturnpaymentid', $_POST['salesreturnpayment__salesreturnpaymentid']);
$q = $this->db->get('salesreturnpayment');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (!isset($_POST['salesreturnpayment__customer_id']) || ($_POST['salesreturnpayment__customer_id'] == "" || $_POST['salesreturnpayment__customer_id'] == null  || $_POST['salesreturnpayment__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salesreturnpayment__currency_id']) || ($_POST['salesreturnpayment__currency_id'] == "" || $_POST['salesreturnpayment__currency_id'] == null  || $_POST['salesreturnpayment__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['salesreturnpayment__paymenttype'] == "Cash Bank")
if (!isset($_POST['salesreturnpayment__cashbank_id']) || ($_POST['salesreturnpayment__cashbank_id'] == "" || $_POST['salesreturnpayment__cashbank_id'] == null  || $_POST['salesreturnpayment__cashbank_id'] == null))
$error .= "<span class='error'>Cash Bank must not be empty"."</span><br>";

if ($_POST['salesreturnpayment__paymenttype'] == "Giro")
if (!isset($_POST['salesreturnpayment__giroout_id']) || ($_POST['salesreturnpayment__giroout_id'] == "" || $_POST['salesreturnpayment__giroout_id'] == null  || $_POST['salesreturnpayment__giroout_id'] == null))
$error .= "<span class='error'>Giro Out must not be empty"."</span><br>";

if ($_POST['salesreturnpayment__paymenttype'] == "Credit Note")
if (!isset($_POST['salesreturnpayment__creditnoteout_id']) || ($_POST['salesreturnpayment__creditnoteout_id'] == "" || $_POST['salesreturnpayment__creditnoteout_id'] == null  || $_POST['salesreturnpayment__creditnoteout_id'] == null))
$error .= "<span class='error'>Credit Note Out must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salesreturnpayment__date']))
$this->db->set('date', "str_to_date('".$_POST['salesreturnpayment__date']."', '%d-%m-%Y')", false);if (isset($_POST['salesreturnpayment__salesreturnpaymentid']))
$data['salesreturnpaymentid'] = $_POST['salesreturnpayment__salesreturnpaymentid'];if (isset($_POST['salesreturnpayment__customer_id']))
$data['customer_id'] = $_POST['salesreturnpayment__customer_id'];if (isset($_POST['salesreturnpayment__currency_id']))
$data['currency_id'] = $_POST['salesreturnpayment__currency_id'];if (isset($_POST['salesreturnpayment__currencyrate']))
$data['currencyrate'] = $_POST['salesreturnpayment__currencyrate'];if (isset($_POST['salesreturnpayment__paymenttype']))
$data['paymenttype'] = $_POST['salesreturnpayment__paymenttype'];if (isset($_POST['salesreturnpayment__cashbank_id']))
$data['cashbank_id'] = $_POST['salesreturnpayment__cashbank_id'];if (isset($_POST['salesreturnpayment__giroout_id']))
$data['giroout_id'] = $_POST['salesreturnpayment__giroout_id'];if (isset($_POST['salesreturnpayment__creditnoteout_id']))
$data['creditnoteout_id'] = $_POST['salesreturnpayment__creditnoteout_id'];if (isset($_POST['salesreturnpayment__total']))
$data['total'] = $_POST['salesreturnpayment__total'];if (isset($_POST['salesreturnpayment__totalpay']))
$data['totalpay'] = $_POST['salesreturnpayment__totalpay'];if (isset($_POST['salesreturnpayment__adjustment']))
$data['adjustment'] = $_POST['salesreturnpayment__adjustment'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salesreturnpayment', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salesreturnpayment_id = $this->db->insert_id();


$length = count($_POST['salesreturnpaymentline__salesreturninvoice_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['salesreturnpaymentline__salesreturninvoice_id'][$i]))
$coldata[$i]['salesreturninvoice_id'] = $_POST['salesreturnpaymentline__salesreturninvoice_id'][$i];
if (isset($_POST['salesreturnpaymentline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['salesreturnpaymentline__lastupdate'][$i];
if (isset($_POST['salesreturnpaymentline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['salesreturnpaymentline__updatedby'][$i];
if (isset($_POST['salesreturnpaymentline__created'][$i]))
$coldata[$i]['created'] = $_POST['salesreturnpaymentline__created'][$i];
if (isset($_POST['salesreturnpaymentline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['salesreturnpaymentline__createdby'][$i];
$coldata[$i]['salesreturnpayment_id'] = $salesreturnpayment_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('salesreturnpaymentline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_return_paymentadd','salesreturnpayment','aftersave', $salesreturnpayment_id);
			
		
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