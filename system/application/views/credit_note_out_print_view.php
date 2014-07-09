<html>
<head><title>Credit Note</title>
<link href="<?=base_url();?>css/reportstyle.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="reportheader">
	<div class="company">
		<img src="<?=base_url();?>css/images/zentrum_logo.gif"><br/>
		PT Zentrum Graphics Asia<br/>
		Jl. Raya Serpong Km 7<br/>
		Komplek Multiguna AI/1<br/>
		Serpong - Tangerang 15310<br/>
		Banten - Indonesia<br/>
	</div>

	<h1>Credit Note</h1>
</div>

<?php
$this->db->where("id", $id);
$this->db->select('DATE_FORMAT(date, "%d-%m-%Y") as date',false);
$this->db->select('DATE_FORMAT(expirydate, "%d-%m-%Y") as expirydate',false);
$this->db->select('customer_id, currency_id, notes, creditnoteoutid, amount');
$q = $this->db->get("creditnoteout");

$creditnoteout = $q->row_array();

$this->db->where("id", $creditnoteout['customer_id']);
$q = $this->db->get("customer");

$customer = $q->row_array();

$this->db->where("id", $creditnoteout['currency_id']);
$q = $this->db->get("currency");

$currency = $q->row_array();
//print_r($salesinvoice);
//echo "<br>";
//print_r($salesinvoiceline);

?>
<div class="creditnote">
	<table>
	<tr><td>No</td><td>:</td><td><?=$creditnoteout['creditnoteoutid'];?></td></tr>
	<tr><td>Date</td><td>:</td><td> <?=$creditnoteout['date'];?></td></tr>
	<tr><td colspan="3">Description:</td></tr>
	<tr><td colspan="3" class="notes"><?=$creditnoteout['notes'];?></td></tr>
	<tr><td>Amount</td><td>:</td><td><?=$currency['name'];?>&nbsp;<?=number_format($creditnoteout['amount'],0);?></td></tr>
	<tr><td>Expiry Date</td><td>:</td><td><?=$creditnoteout['expirydate'];?></td></tr>
	</table>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>