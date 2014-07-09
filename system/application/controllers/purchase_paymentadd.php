<?php

class purchase_paymentadd extends Controller {

	function purchase_paymentadd()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index($id = 0)
	{
		$data = array();
		
		
$data['purchasepayment__date'] = '';
$data['purchasepayment__purchasepaymentid'] = '';$this->load->library('generallib');
$data['purchasepayment__purchasepaymentid'] = $this->generallib->genId('Purchase Payment');
$supplier_opt = array();
$supplier_opt[''] = 'None';
$q = $this->db->get('supplier');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $supplier_opt[$row->id] = $row->firstname; }
$data['supplier_opt'] = $supplier_opt;
$data['purchasepayment__supplier_id'] = '';
$currency_opt = array();
$currency_opt[''] = 'None';
$q = $this->db->get('currency');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $currency_opt[$row->id] = $row->name; }
$data['currency_opt'] = $currency_opt;
$data['purchasepayment__currency_id'] = '';
$data['purchasepayment__currencyrate'] = '';
$data['purchasepayment__paymenttype'] = '';
$cashbank_opt = array();
$cashbank_opt[''] = 'None';
$q = $this->db->get('cashbank');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $cashbank_opt[$row->id] = $row->name; }
$data['cashbank_opt'] = $cashbank_opt;
$data['purchasepayment__cashbank_id'] = '';
$giroout_opt = array();
$giroout_opt[''] = 'None';
$q = $this->db->get('giroout');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $giroout_opt[$row->id] = $row->girooutid; }
$data['giroout_opt'] = $giroout_opt;
$data['purchasepayment__giroout_id'] = '';
$creditnotein_opt = array();
$creditnotein_opt[''] = 'None';
$q = $this->db->get('creditnotein');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $creditnotein_opt[$row->id] = $row->creditnoteinid; }
$data['creditnotein_opt'] = $creditnotein_opt;
$data['purchasepayment__creditnotein_id'] = '';$this->load->library('generallib');
$data['purchasepayment__creditnotein_id'] = $this->generallib->genId('Purchase Payment');
$data['purchasepayment__total'] = '';
$data['purchasepayment__totalpay'] = '';
$data['purchasepayment__adjustment'] = '';
$data['purchasepayment__lastupdate'] = '';
$data['purchasepayment__updatedby'] = '';
$data['purchasepayment__created'] = '';
$data['purchasepayment__createdby'] = '';if (isset($_POST['date']) && $_POST['date'] != -1){$data['purchasepayment__date'] = $_POST['date'];}if (isset($_POST['purchasepaymentid']) && $_POST['purchasepaymentid'] != -1){$data['purchasepayment__purchasepaymentid'] = $_POST['purchasepaymentid'];}if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != -1){$data['purchasepayment__supplier_id'] = $_POST['supplier_id'];}if (isset($_POST['currency_id']) && $_POST['currency_id'] != -1){$data['purchasepayment__currency_id'] = $_POST['currency_id'];}if (isset($_POST['currencyrate']) && $_POST['currencyrate'] != -1){$data['purchasepayment__currencyrate'] = $_POST['currencyrate'];}if (isset($_POST['paymenttype']) && $_POST['paymenttype'] != -1){$data['purchasepayment__paymenttype'] = $_POST['paymenttype'];}if (isset($_POST['cashbank_id']) && $_POST['cashbank_id'] != -1){$data['purchasepayment__cashbank_id'] = $_POST['cashbank_id'];}if (isset($_POST['giroout_id']) && $_POST['giroout_id'] != -1){$data['purchasepayment__giroout_id'] = $_POST['giroout_id'];}if (isset($_POST['creditnotein_id']) && $_POST['creditnotein_id'] != -1){$data['purchasepayment__creditnotein_id'] = $_POST['creditnotein_id'];}if (isset($_POST['total']) && $_POST['total'] != -1){$data['purchasepayment__total'] = $_POST['total'];}if (isset($_POST['totalpay']) && $_POST['totalpay'] != -1){$data['purchasepayment__totalpay'] = $_POST['totalpay'];}if (isset($_POST['adjustment']) && $_POST['adjustment'] != -1){$data['purchasepayment__adjustment'] = $_POST['adjustment'];}if (isset($_POST['lastupdate']) && $_POST['lastupdate'] != -1){$data['purchasepayment__lastupdate'] = $_POST['lastupdate'];}if (isset($_POST['updatedby']) && $_POST['updatedby'] != -1){$data['purchasepayment__updatedby'] = $_POST['updatedby'];}if (isset($_POST['created']) && $_POST['created'] != -1){$data['purchasepayment__created'] = $_POST['created'];}if (isset($_POST['createdby']) && $_POST['createdby'] != -1){$data['purchasepayment__createdby'] = $_POST['createdby'];}
if (!isset($_POST['purchaseinvoice__id'])) { echo 'You must at least tick one option'; return; }
$purchaseinvoice_ids = $_POST['purchaseinvoice__id'];
$linedata = array();
foreach ($purchaseinvoice_ids as $purchaseinvoice_id)
{
$this->db->where('id', $purchaseinvoice_id);
$qq = $this->db->get('purchaseinvoice');
if (isset($qq->row()->supplier_id)) {
if ($data['purchasepayment__supplier_id'] > 0 && $data['purchasepayment__supplier_id'] != $qq->row()->supplier_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasepayment__supplier_id'] = $qq->row()->supplier_id;
}
if (isset($qq->row()->currency_id)) {
if ($data['purchasepayment__currency_id'] > 0 && $data['purchasepayment__currency_id'] != $qq->row()->currency_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasepayment__currency_id'] = $qq->row()->currency_id;
}
if (isset($qq->row()->cashbank_id)) {
if ($data['purchasepayment__cashbank_id'] > 0 && $data['purchasepayment__cashbank_id'] != $qq->row()->cashbank_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasepayment__cashbank_id'] = $qq->row()->cashbank_id;
}
if (isset($qq->row()->giroout_id)) {
if ($data['purchasepayment__giroout_id'] > 0 && $data['purchasepayment__giroout_id'] != $qq->row()->giroout_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasepayment__giroout_id'] = $qq->row()->giroout_id;
}
if (isset($qq->row()->creditnotein_id)) {
if ($data['purchasepayment__creditnotein_id'] > 0 && $data['purchasepayment__creditnotein_id'] != $qq->row()->creditnotein_id) {
echo 'Incorrect options selected from previous page, please use all the filters available.';return;
}
$data['purchasepayment__creditnotein_id'] = $qq->row()->creditnotein_id;
}
if (isset($qq->row()->purchaseinvoice_id))
$linedata['purchasepaymentline__purchaseinvoice_id'] = $qq->row()->purchaseinvoice_id;
else
$linedata['purchasepaymentline__purchaseinvoice_id'] = null;
$purchaseinvoice_opt = array();
$purchaseinvoice_opt[''] = 'None';
$q = $this->db->get('purchaseinvoice');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $purchaseinvoice_opt[$row->id] = $row->orderid; }
$data['purchaseinvoice_opt'] = $purchaseinvoice_opt;
if (isset($qq->row()->lastupdate))
$linedata['purchasepaymentline__lastupdate'] = $qq->row()->lastupdate;
else
$linedata['purchasepaymentline__lastupdate'] = null;
if (isset($qq->row()->updatedby))
$linedata['purchasepaymentline__updatedby'] = $qq->row()->updatedby;
else
$linedata['purchasepaymentline__updatedby'] = null;
if (isset($qq->row()->created))
$linedata['purchasepaymentline__created'] = $qq->row()->created;
else
$linedata['purchasepaymentline__created'] = null;
if (isset($qq->row()->createdby))
$linedata['purchasepaymentline__createdby'] = $qq->row()->createdby;
else
$linedata['purchasepaymentline__createdby'] = null;
$linedata['purchasepaymentline__purchaseinvoice_id'] = $purchaseinvoice_id;
$data['purchasepaymentline_data'][$purchaseinvoice_id] = $linedata;
}
$sum = 0; foreach($_POST['purchaseinvoice__id'] as $tid){ $this->db->where('id', $tid);$q = $this->db->get('purchaseinvoice'); $sum += $q->row()->total; }
$data['purchasepayment__total'] = $sum;
		

		$this->load->view('purchase_payment_add_form', $data);
	}
	
	function submit()
	{
		$error = "";
		
		
if (isset($_POST['purchasepayment__date']) && ($_POST['purchasepayment__date'] == "" || $_POST['purchasepayment__date'] == null))
$error .= "<span class='error'>Date must not be empty"."</span><br>";

if (isset($_POST['purchasepayment__purchasepaymentid']) && ($_POST['purchasepayment__purchasepaymentid'] == "" || $_POST['purchasepayment__purchasepaymentid'] == null))
$error .= "<span class='error'>Purchase Payment No must not be empty"."</span><br>";

if (isset($_POST['purchasepayment__purchasepaymentid'])) {
$this->db->where('purchasepaymentid', $_POST['purchasepayment__purchasepaymentid']);
$q = $this->db->get('purchasepayment');
if ($q->num_rows() > 0) $error .= "<span class='error'>Purchase Payment No must be unique"."</span><br>";}

if (!isset($_POST['purchasepayment__supplier_id']) || ($_POST['purchasepayment__supplier_id'] == "" || $_POST['purchasepayment__supplier_id'] == null  || $_POST['purchasepayment__supplier_id'] == null))
$error .= "<span class='error'>Supplier must not be empty"."</span><br>";

if (!isset($_POST['purchasepayment__currency_id']) || ($_POST['purchasepayment__currency_id'] == "" || $_POST['purchasepayment__currency_id'] == null  || $_POST['purchasepayment__currency_id'] == null))
$error .= "<span class='error'>Currency must not be empty"."</span><br>";

if ($_POST['purchasepayment__paymenttype'] == "Cash Bank")
if (!isset($_POST['purchasepayment__cashbank_id']) || ($_POST['purchasepayment__cashbank_id'] == "" || $_POST['purchasepayment__cashbank_id'] == null  || $_POST['purchasepayment__cashbank_id'] == null))
$error .= "<span class='error'>Cash Bank must not be empty"."</span><br>";

if ($_POST['purchasepayment__paymenttype'] == "Giro")
if (!isset($_POST['purchasepayment__giroout_id']) || ($_POST['purchasepayment__giroout_id'] == "" || $_POST['purchasepayment__giroout_id'] == null  || $_POST['purchasepayment__giroout_id'] == null))
$error .= "<span class='error'>Giro Out must not be empty"."</span><br>";

if ($_POST['purchasepayment__paymenttype'] == "Credit Note")
if (!isset($_POST['purchasepayment__creditnotein_id']) || ($_POST['purchasepayment__creditnotein_id'] == "" || $_POST['purchasepayment__creditnotein_id'] == null  || $_POST['purchasepayment__creditnotein_id'] == null))
$error .= "<span class='error'>Credit Note In must not be empty"."</span><br>";

		
		if ($error == "")
		{
			
$data = array();if (isset($_POST['purchasepayment__date']))
$this->db->set('date', "str_to_date('".$_POST['purchasepayment__date']."', '%d-%m-%Y')", false);if (isset($_POST['purchasepayment__purchasepaymentid']))
$data['purchasepaymentid'] = $_POST['purchasepayment__purchasepaymentid'];if (isset($_POST['purchasepayment__supplier_id']))
$data['supplier_id'] = $_POST['purchasepayment__supplier_id'];if (isset($_POST['purchasepayment__currency_id']))
$data['currency_id'] = $_POST['purchasepayment__currency_id'];if (isset($_POST['purchasepayment__currencyrate']))
$data['currencyrate'] = $_POST['purchasepayment__currencyrate'];if (isset($_POST['purchasepayment__paymenttype']))
$data['paymenttype'] = $_POST['purchasepayment__paymenttype'];if (isset($_POST['purchasepayment__cashbank_id']))
$data['cashbank_id'] = $_POST['purchasepayment__cashbank_id'];if (isset($_POST['purchasepayment__giroout_id']))
$data['giroout_id'] = $_POST['purchasepayment__giroout_id'];if (isset($_POST['purchasepayment__creditnotein_id']))
$data['creditnotein_id'] = $_POST['purchasepayment__creditnotein_id'];if (isset($_POST['purchasepayment__total']))
$data['total'] = $_POST['purchasepayment__total'];if (isset($_POST['purchasepayment__totalpay']))
$data['totalpay'] = $_POST['purchasepayment__totalpay'];if (isset($_POST['purchasepayment__adjustment']))
$data['adjustment'] = $_POST['purchasepayment__adjustment'];
$data['lastupdate'] = date('Y-m-d H:i:s');
$data['updatedby'] = $this->session->userdata('user');
$data['created'] = date('Y-m-d H:i:s');
$data['createdby'] = $this->session->userdata('user');
$this->db->insert('purchasepayment', $data);
$this->session->set_userdata('last_insert_id', $this->db->insert_id());
$purchasepayment_id = $this->db->insert_id();


$length = count($_POST['purchasepaymentline__purchaseinvoice_id']);
$coldata = array();
for ($i=0;$i<$length;$i++)
{
if (isset($_POST['purchasepaymentline__purchaseinvoice_id'][$i]))
$coldata[$i]['purchaseinvoice_id'] = $_POST['purchasepaymentline__purchaseinvoice_id'][$i];
if (isset($_POST['purchasepaymentline__lastupdate'][$i]))
$coldata[$i]['lastupdate'] = $_POST['purchasepaymentline__lastupdate'][$i];
if (isset($_POST['purchasepaymentline__updatedby'][$i]))
$coldata[$i]['updatedby'] = $_POST['purchasepaymentline__updatedby'][$i];
if (isset($_POST['purchasepaymentline__created'][$i]))
$coldata[$i]['created'] = $_POST['purchasepaymentline__created'][$i];
if (isset($_POST['purchasepaymentline__createdby'][$i]))
$coldata[$i]['createdby'] = $_POST['purchasepaymentline__createdby'][$i];
$coldata[$i]['purchasepayment_id'] = $purchasepayment_id;
}

for ($i=0;$i<$length;$i++)
{
$linedata = $coldata[$i];
$this->db->insert('purchasepaymentline', $linedata);
}
$this->load->library('generallib');
$error .= $this->generallib->commonfunction('purchase_paymentadd','purchasepayment','aftersave', $purchasepayment_id);
			
		
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