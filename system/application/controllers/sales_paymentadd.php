<?php

class sales_paymentadd extends Controller {

	function sales_paymentadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['salespayment__date'] = '';
$data['salespayment__orderid'] = '';$this->load->library('generallib');
$data['salespayment__orderid'] = $this->generallib->genId('Sales Payment');
$customer_opt = array();
$customer_opt[''] = 'None';
$q = $this->db->get('customer');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $customer_opt[$row->id] = $row->firstname; }
$data['customer_opt'] = $customer_opt;
$data['salespayment__customer_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['salespayment__currency_id'] = '';
$data['salespayment__currencyrate'] = '';
$data['salespayment__paymenttype'] = '';
$cashbank_opt = array();
$cashbank_opt[''] = 'None';
$q = $this->db->get('cashbank');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['salespayment__cashbank_id'] = '';
$giroin_opt = array();
$giroin_opt[''] = 'None';
$q = $this->db->get('giroin');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['salespayment__giroin_id'] = '';
$creditnoteout_opt = array();
$creditnoteout_opt[''] = 'None';
$q = $this->db->get('creditnoteout');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $creditnoteout_opt[$row->id] = $row->creditnoteoutid; }
$data['creditnoteout_opt'] = $creditnoteout_opt;
$data['salespayment__creditnoteout_id'] = '';$this->load->library('generallib');
$data['salespayment__creditnoteout_id'] = $this->generallib->genId('Sales Payment');
$data['salespayment__total'] = '';
$data['salespayment__totalpay'] = '';
$data['salespayment__adjustment'] = '';
$data['salespayment__lastupdate'] = '';
$data['salespayment__updatedby'] = '';
$data['salespayment__created'] = '';
$data['salespayment__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['salespayment__date'] = $_POST['date'];}if (isset($_POST['orderid']) && $_POST['orderid'] != -1){$data['salespayment__orderid'] = $_POST['orderid'];}if (isset($_POST['customer_id']) && $_POST['customer_id'] != -1){$data['salespayment__customer_id'] = $_POST['customer_id'];}if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1){$data['salespayment__currency_id'] = $_POST['currency_id'];}if (isset($_POST['currencyrate']) && $_POST['currencyrate'] != -1){$data['salespayment__currencyrate'] = $_POST['currencyrate'];}if (isset($_POST['paymenttype']) && $_POST['paymenttype'] != -1){$data['salespayment__paymenttype'] = $_POST['paymenttype'];}if (isset($_POST['cashbank_id']) && $_POST['cashbank_id'] != -1){$data['salespayment__cashbank_id'] = $_POST['cashbank_id'];}if (isset($_POST['giroin_id']) && $_POST['giroin_id'] != -1){$data['salespayment__giroin_id'] = $_POST['giroin_id'];}if (isset($_POST['creditnoteout_id']) && $_POST['creditnoteout_id'] != -1){$data['salespayment__creditnoteout_id'] = $_POST['creditnoteout_id'];}if (isset($_POST['total']) && $_POST['total'] != -1){$data['salespayment__total'] = $_POST['total'];}if (isset($_POST['totalpay']) && $_POST['totalpay'] != -1){$data['salespayment__totalpay'] = $_POST['totalpay'];}if (isset($_POST['adjustment']) && $_POST['adjustment'] != -1){$data['salespayment__adjustment'] = $_POST['adjustment'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['salespayment__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['salespayment__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['salespayment__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['salespayment__createdby'] = $_POST['createdby'];}
if (!isset($_POST['salesinvoice__id'])) { echo 'You must at least tick one option'; return; }
$salesinvoice_ids = $_POST['salesinvoice__id'];
$linedata = array();
foreach ($salesinvoice_ids as $salesinvoice_id)
{
$this->db->where('id', $salesinvoice_id);
$qq = $this->db->get('salesinvoice');
if (isset($qq->row()->customer_id)) {
if ($data['salespayment__customer_id'] > 0 && $data['salespayment__customer_id'] != $qq->row()->customer_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salespayment__customer_id'] = $qq->row()->customer_id;
}
if (isset($qq->row()->currency_id)) {
if ($data['salespayment__currency_id'] > 0 && $data['salespayment__currency_id'] != $qq->row()->currency_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salespayment__currency_id'] = $qq->row()->currency_id;
}
if (isset($qq->row()->cashbank_id)) {
if ($data['salespayment__cashbank_id'] > 0 && $data['salespayment__cashbank_id'] != $qq->row()->cashbank_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salespayment__cashbank_id'] = $qq->row()->cashbank_id;
}
if (isset($qq->row()->giroin_id)) {
if ($data['salespayment__giroin_id'] > 0 && $data['salespayment__giroin_id'] != $qq->row()->giroin_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salespayment__giroin_id'] = $qq->row()->giroin_id;
}
if (isset($qq->row()->creditnoteout_id)) {
if ($data['salespayment__creditnoteout_id'] > 0 && $data['salespayment__creditnoteout_id'] != $qq->row()->creditnoteout_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['salespayment__creditnoteout_id'] = $qq->row()->creditnoteout_id;
}
if (isset($qq->row()->salesinvoice_id))
$linedata['salespaymentline__salesinvoice_id'] = $qq->row()->salesinvoice_id;
else
$linedata['salespaymentline__salesinvoice_id'] = null;
$salesinvoice_opt = array();
$salesinvoice_opt[''] = 'None';
$q = $this->db->get('salesinvoice');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $salesinvoice_opt[$row->id] = $row->orderid; }
$data['salesinvoice_opt'] = $salesinvoice_opt;
if (isset($qq->row()->lastupdate))
$linedata['salespaymentline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['salespaymentline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['salespaymentline__updatedby'] = $qq->row()->updatedby;
else
$linedata['salespaymentline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['salespaymentline__created'] = $qq->row()->created;
else
$linedata['salespaymentline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['salespaymentline__createdby'] = $qq->row()->createdby;
else
$linedata['salespaymentline__createdby'] = null;
$linedata['salespaymentline__salesinvoice_id'] = $salesinvoice_id;
$data['salespaymentline_data'][$salesinvoice_id] = $linedata;
}
$sum = 0; foreach($_POST['salesinvoice__id'] as $tid){ $this->db->where('id', $tid);$q = $this->db->get('salesinvoice'); $sum += $q->row()->total; }
$data['salespayment__total'] = $sum;
		

		$this->load->view('sales_payment_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['salespayment__date']) && ($_POST['salespayment__date'] == "" || $_POST['salespayment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['salespayment__orderid']) && ($_POST['salespayment__orderid'] == "" || $_POST['salespayment__orderid'] == null))
$error .= "<span class='error'>Sales Payment No must not be empty"."</span><br>";

if (isset($_POST['salespayment__orderid'])) {
$this->db->where('orderid', $_POST['salespayment__orderid']);
$q = $this->db->get('salespayment');
if ($q->num_rows() > 0) $error .= "<span class='error'>Sales Payment No must be unique"."</span><br>";}

if (!isset($_POST['salespayment__customer_id']) || ($_POST['salespayment__customer_id'] == "" || $_POST['salespayment__customer_id'] == null  || $_POST['salespayment__customer_id'] == null))
$error .= "<span class='error'>Customer must not be empty"."</span><br>";

if (!isset($_POST['salespayment__currency_id']) || ($_POST['salespayment__currency_id'] == "" || $_POST['salespayment__currency_id'] == null  || $_POST['salespayment__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['salespayment__paymenttype'] == "Cash Bank")
if (!isset($_POST['salespayment__cashbank_id']) || ($_POST['salespayment__cashbank_id'] == "" || $_POST['salespayment__cashbank_id'] == null  || $_POST['salespayment__cashbank_id'] == null))
$error .= "<span class='error'>Cash Bank must not be empty"."</span><br>";

if ($_POST['salespayment__paymenttype'] == "Giro")
if (!isset($_POST['salespayment__giroin_id']) || ($_POST['salespayment__giroin_id'] == "" || $_POST['salespayment__giroin_id'] == null  || $_POST['salespayment__giroin_id'] == null))
$error .= "<span class='error'>Giro In must not be empty"."</span><br>";

if ($_POST['salespayment__paymenttype'] == "Credit Note")
if (!isset($_POST['salespayment__creditnoteout_id']) || ($_POST['salespayment__creditnoteout_id'] == "" || $_POST['salespayment__creditnoteout_id'] == null  || $_POST['salespayment__creditnoteout_id'] == null))
$error .= "<span class='error'>Credit Note Out must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['salespayment__date']))
$this->db->set('date', "str_to_date('".$_POST['salespayment__date']."', '%d-%m-%Y')", false);if (isset($_POST['salespayment__orderid']))
$data['orderid'] = $_POST['salespayment__orderid'];if (isset($_POST['salespayment__customer_id']))
$data['customer_id'] = $_POST['salespayment__customer_id'];if (isset($_POST['salespayment__currency_id']))
$data['currency_id'] = $_POST['salespayment__currency_id'];if (isset($_POST['salespayment__currencyrate']))
$data['currencyrate'] = $_POST['salespayment__currencyrate'];if (isset($_POST['salespayment__paymenttype']))
$data['paymenttype'] = $_POST['salespayment__paymenttype'];if (isset($_POST['salespayment__cashbank_id']))
$data['cashbank_id'] = $_POST['salespayment__cashbank_id'];if (isset($_POST['salespayment__giroin_id']))
$data['giroin_id'] = $_POST['salespayment__giroin_id'];if (isset($_POST['salespayment__creditnoteout_id']))
$data['creditnoteout_id'] = $_POST['salespayment__creditnoteout_id'];if (isset($_POST['salespayment__total']))
$data['total'] = $_POST['salespayment__total'];if (isset($_POST['salespayment__totalpay']))
$data['totalpay'] = $_POST['salespayment__totalpay'];if (isset($_POST['salespayment__adjustment']))
$data['adjustment'] = $_POST['salespayment__adjustment'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('salespayment', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$salespayment_id = $this->db->insert_id();


$length = count($_POST['salespaymentline__salesinvoice_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['salespaymentline__salesinvoice_id'][$i]))
$coldata[$i]['salesinvoice_id'] = $_POST['salespaymentline__salesinvoice_id'][$i];
if (isset($_POST['salespaymentline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['salespaymentline__lastupdate'][$i];
if (isset($_POST['salespaymentline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['salespaymentline__updatedby'][$i];
if (isset($_POST['salespaymentline__created'][$i]))
$coldata[$i]['created'] = $_POST['salespaymentline__created'][$i];
if (isset($_POST['salespaymentline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['salespaymentline__createdby'][$i];
$coldata[$i]['salespayment_id'] = $salespayment_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('salespaymentline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('sales_paymentadd','salespayment','aftersave', $salespayment_id);
			
		
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