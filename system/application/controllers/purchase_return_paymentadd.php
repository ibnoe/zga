<?php

class purchase_return_paymentadd extends Controller {

	function purchase_return_paymentadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasereturnpayment__date'] = '';
$data['purchasereturnpayment__purchasereturnpaymentid'] = '';$this->load->library('generallib');
$data['purchasereturnpayment__purchasereturnpaymentid'] = $this->generallib->genId('Purchase Return Payment');
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasereturnpayment__supplier_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasereturnpayment__currency_id'] = '';
$data['purchasereturnpayment__currencyrate'] = '';
$data['purchasereturnpayment__paymenttype'] = '';
$cashbank_opt = array();
$cashbank_opt[''] = 'None';
$q = $this->db->get('cashbank');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['purchasereturnpayment__cashbank_id'] = '';
$giroin_opt = array();
$giroin_opt[''] = 'None';
$q = $this->db->get('giroin');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $giroin_opt[$row->id] = $row->giroinid; }
$data['giroin_opt'] = $giroin_opt;
$data['purchasereturnpayment__giroin_id'] = '';
$creditnotein_opt = array();
$creditnotein_opt[''] = 'None';
$q = $this->db->get('creditnotein');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $creditnotein_opt[$row->id] = $row->creditnoteinid; }
$data['creditnotein_opt'] = $creditnotein_opt;
$data['purchasereturnpayment__creditnotein_id'] = '';$this->load->library('generallib');
$data['purchasereturnpayment__creditnotein_id'] = $this->generallib->genId('Purchase Return Payment');
$data['purchasereturnpayment__total'] = '';
$data['purchasereturnpayment__totalpay'] = '';
$data['purchasereturnpayment__adjustment'] = '';
$data['purchasereturnpayment__lastupdate'] = '';
$data['purchasereturnpayment__updatedby'] = '';
$data['purchasereturnpayment__created'] = '';
$data['purchasereturnpayment__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['purchasereturnpayment__date'] = $_POST['date'];}if (isset($_POST['purchasereturnpaymentid']) && $_POST['purchasereturnpaymentid'] != -1){$data['purchasereturnpayment__purchasereturnpaymentid'] = $_POST['purchasereturnpaymentid'];}if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1){$data['purchasereturnpayment__supplier_id'] = $_POST['supplier_id'];}if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1){$data['purchasereturnpayment__currency_id'] = $_POST['currency_id'];}if (isset($_POST['currencyrate']) && $_POST['currencyrate'] != -1){$data['purchasereturnpayment__currencyrate'] = $_POST['currencyrate'];}if (isset($_POST['paymenttype']) && $_POST['paymenttype'] != -1){$data['purchasereturnpayment__paymenttype'] = $_POST['paymenttype'];}if (isset($_POST['cashbank_id']) && $_POST['cashbank_id'] != -1){$data['purchasereturnpayment__cashbank_id'] = $_POST['cashbank_id'];}if (isset($_POST['giroin_id']) && $_POST['giroin_id'] != -1){$data['purchasereturnpayment__giroin_id'] = $_POST['giroin_id'];}if (isset($_POST['creditnotein_id']) && $_POST['creditnotein_id'] != -1){$data['purchasereturnpayment__creditnotein_id'] = $_POST['creditnotein_id'];}if (isset($_POST['total']) && $_POST['total'] != -1){$data['purchasereturnpayment__total'] = $_POST['total'];}if (isset($_POST['totalpay']) && $_POST['totalpay'] != -1){$data['purchasereturnpayment__totalpay'] = $_POST['totalpay'];}if (isset($_POST['adjustment']) && $_POST['adjustment'] != -1){$data['purchasereturnpayment__adjustment'] = $_POST['adjustment'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['purchasereturnpayment__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['purchasereturnpayment__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['purchasereturnpayment__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['purchasereturnpayment__createdby'] = $_POST['createdby'];}
if (!isset($_POST['purchasereturninvoice__id'])) { echo 'You must at least tick one option'; return; }
$purchasereturninvoice_ids = $_POST['purchasereturninvoice__id'];
$linedata = array();
foreach ($purchasereturninvoice_ids as $purchasereturninvoice_id)
{
$this->db->where('id', $purchasereturninvoice_id);
$qq = $this->db->get('purchasereturninvoice');
if (isset($qq->row()->supplier_id)) {
if ($data['purchasereturnpayment__supplier_id'] > 0 && $data['purchasereturnpayment__supplier_id'] != $qq->row()->supplier_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturnpayment__supplier_id'] = $qq->row()->supplier_id;
}
if (isset($qq->row()->currency_id)) {
if ($data['purchasereturnpayment__currency_id'] > 0 && $data['purchasereturnpayment__currency_id'] != $qq->row()->currency_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturnpayment__currency_id'] = $qq->row()->currency_id;
}
if (isset($qq->row()->cashbank_id)) {
if ($data['purchasereturnpayment__cashbank_id'] > 0 && $data['purchasereturnpayment__cashbank_id'] != $qq->row()->cashbank_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturnpayment__cashbank_id'] = $qq->row()->cashbank_id;
}
if (isset($qq->row()->giroin_id)) {
if ($data['purchasereturnpayment__giroin_id'] > 0 && $data['purchasereturnpayment__giroin_id'] != $qq->row()->giroin_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturnpayment__giroin_id'] = $qq->row()->giroin_id;
}
if (isset($qq->row()->creditnotein_id)) {
if ($data['purchasereturnpayment__creditnotein_id'] > 0 && $data['purchasereturnpayment__creditnotein_id'] != $qq->row()->creditnotein_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasereturnpayment__creditnotein_id'] = $qq->row()->creditnotein_id;
}
if (isset($qq->row()->purchasereturninvoice_id))
$linedata['purchasereturnpaymentline__purchasereturninvoice_id'] = $qq->row()->purchasereturninvoice_id;
else
$linedata['purchasereturnpaymentline__purchasereturninvoice_id'] = null;
$purchasereturninvoice_opt = array();
$purchasereturninvoice_opt[''] = 'None';
$q = $this->db->get('purchasereturninvoice');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchasereturninvoice_opt[$row->id] = $row->purchasereturninvoiceid; }
$data['purchasereturninvoice_opt'] = $purchasereturninvoice_opt;
if (isset($qq->row()->lastupdate))
$linedata['purchasereturnpaymentline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['purchasereturnpaymentline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['purchasereturnpaymentline__updatedby'] = $qq->row()->updatedby;
else
$linedata['purchasereturnpaymentline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['purchasereturnpaymentline__created'] = $qq->row()->created;
else
$linedata['purchasereturnpaymentline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['purchasereturnpaymentline__createdby'] = $qq->row()->createdby;
else
$linedata['purchasereturnpaymentline__createdby'] = null;
$linedata['purchasereturnpaymentline__purchasereturninvoice_id'] = $purchasereturninvoice_id;
$data['purchasereturnpaymentline_data'][$purchasereturninvoice_id] = $linedata;
}
$sum = 0; foreach($_POST['purchasereturninvoice__id'] as $tid){ $this->db->where('id', $tid);$q = $this->db->get('purchasereturninvoice'); $sum += $q->row()->total; }
$data['purchasereturnpayment__total'] = $sum;
		

		$this->load->view('purchase_return_payment_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchasereturnpayment__date']) && ($_POST['purchasereturnpayment__date'] == "" || $_POST['purchasereturnpayment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasereturnpayment__purchasereturnpaymentid']) && ($_POST['purchasereturnpayment__purchasereturnpaymentid'] == "" || $_POST['purchasereturnpayment__purchasereturnpaymentid'] == null))
$error .= "<span class='error'>ID must not be empty"."</span><br>";

if (isset($_POST['purchasereturnpayment__purchasereturnpaymentid'])) {
$this->db->where('purchasereturnpaymentid', $_POST['purchasereturnpayment__purchasereturnpaymentid']);
$q = $this->db->get('purchasereturnpayment');
if ($q->num_rows() > 0) $error .= "<span class='error'>ID must be unique"."</span><br>";}

if (!isset($_POST['purchasereturnpayment__supplier_id']) || ($_POST['purchasereturnpayment__supplier_id'] == "" || $_POST['purchasereturnpayment__supplier_id'] == null  || $_POST['purchasereturnpayment__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasereturnpayment__currency_id']) || ($_POST['purchasereturnpayment__currency_id'] == "" || $_POST['purchasereturnpayment__currency_id'] == null  || $_POST['purchasereturnpayment__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['purchasereturnpayment__paymenttype'] == "Cash Bank")
if (!isset($_POST['purchasereturnpayment__cashbank_id']) || ($_POST['purchasereturnpayment__cashbank_id'] == "" || $_POST['purchasereturnpayment__cashbank_id'] == null  || $_POST['purchasereturnpayment__cashbank_id'] == null))
$error .= "<span class='error'>Cash Bank must not be empty"."</span><br>";

if ($_POST['purchasereturnpayment__paymenttype'] == "Giro")
if (!isset($_POST['purchasereturnpayment__giroin_id']) || ($_POST['purchasereturnpayment__giroin_id'] == "" || $_POST['purchasereturnpayment__giroin_id'] == null  || $_POST['purchasereturnpayment__giroin_id'] == null))
$error .= "<span class='error'>Giro In must not be empty"."</span><br>";

if ($_POST['purchasereturnpayment__paymenttype'] == "Credit Note")
if (!isset($_POST['purchasereturnpayment__creditnotein_id']) || ($_POST['purchasereturnpayment__creditnotein_id'] == "" || $_POST['purchasereturnpayment__creditnotein_id'] == null  || $_POST['purchasereturnpayment__creditnotein_id'] == null))
$error .= "<span class='error'>Credit Note In must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasereturnpayment__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasereturnpayment__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasereturnpayment__purchasereturnpaymentid']))
$data['purchasereturnpaymentid'] = $_POST['purchasereturnpayment__purchasereturnpaymentid'];if (isset($_POST['purchasereturnpayment__supplier_id']))
$data['supplier_id'] = $_POST['purchasereturnpayment__supplier_id'];if (isset($_POST['purchasereturnpayment__currency_id']))
$data['currency_id'] = $_POST['purchasereturnpayment__currency_id'];if (isset($_POST['purchasereturnpayment__currencyrate']))
$data['currencyrate'] = $_POST['purchasereturnpayment__currencyrate'];if (isset($_POST['purchasereturnpayment__paymenttype']))
$data['paymenttype'] = $_POST['purchasereturnpayment__paymenttype'];if (isset($_POST['purchasereturnpayment__cashbank_id']))
$data['cashbank_id'] = $_POST['purchasereturnpayment__cashbank_id'];if (isset($_POST['purchasereturnpayment__giroin_id']))
$data['giroin_id'] = $_POST['purchasereturnpayment__giroin_id'];if (isset($_POST['purchasereturnpayment__creditnotein_id']))
$data['creditnotein_id'] = $_POST['purchasereturnpayment__creditnotein_id'];if (isset($_POST['purchasereturnpayment__total']))
$data['total'] = $_POST['purchasereturnpayment__total'];if (isset($_POST['purchasereturnpayment__totalpay']))
$data['totalpay'] = $_POST['purchasereturnpayment__totalpay'];if (isset($_POST['purchasereturnpayment__adjustment']))
$data['adjustment'] = $_POST['purchasereturnpayment__adjustment'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasereturnpayment', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasereturnpayment_id = $this->db->insert_id();


$length = count($_POST['purchasereturnpaymentline__purchasereturninvoice_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['purchasereturnpaymentline__purchasereturninvoice_id'][$i]))
$coldata[$i]['purchasereturninvoice_id'] = $_POST['purchasereturnpaymentline__purchasereturninvoice_id'][$i];
if (isset($_POST['purchasereturnpaymentline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['purchasereturnpaymentline__lastupdate'][$i];
if (isset($_POST['purchasereturnpaymentline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['purchasereturnpaymentline__updatedby'][$i];
if (isset($_POST['purchasereturnpaymentline__created'][$i]))
$coldata[$i]['created'] = $_POST['purchasereturnpaymentline__created'][$i];
if (isset($_POST['purchasereturnpaymentline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['purchasereturnpaymentline__createdby'][$i];
$coldata[$i]['purchasereturnpayment_id'] = $purchasereturnpayment_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('purchasereturnpaymentline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_return_paymentadd','purchasereturnpayment','aftersave', $purchasereturnpayment_id);
			
		
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