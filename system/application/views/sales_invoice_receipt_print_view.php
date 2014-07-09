<html>
<head><title>Sales Invoice Receipt</title>
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

	<h1>Sales Invoice Receipt</h1>
</div>


<?php
$this->db->where("id", $id);
$q = $this->db->get("salespayment");

$salespayment = $q->row_array();

$this->db->where("salespayment_id", $id);
$q = $this->db->get("salespaymentline");

$salespaymentline = $q->result_array();

//print_r($salespayment);
//echo "<br>";
//print_r($salespaymentline);

?>
<?php //GET Currency Details
	
	$this->db->where("id", $salespayment['currency_id']);
	$q = $this->db->get("currency");
	$currency = $q->row_array();
?>

<div class="nomor2">
	<table>
	<tr><td>BCA-6050763763</td></tr>
	<tr><td>Date:</td><td> <?=$salespayment['date'];?></td></tr>
	<tr><td>No:</td><td><?=$salespayment['orderid'];?></td></tr>	
	</table>
</div>

<?php //GET CUSTOMER DETAILS
	//$this->db->where("id", $salespayment['customer_id']);
	//$q = $this->db->get("customer");

	//$customer = $q->row_array();
	//print_r($customer);
?>

<div class="linelist">
	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th>Description</th>
			<th>Amount</th>
		</tr>
	<?php $total=0;?>
	<?php foreach($salespaymentline as $line): ?>
		<tr>
			<?php //get sales invoice detail
			
				$this->db->where("id", $line['salesinvoice_id']);
				$q = $this->db->get("salesinvoice");

				$salesinvoice = $q->row_array();
		
				$total += $line['total'];
			?>
			<td class="alignedleft"><?=$salesinvoice['orderid'];?></td>
			<td class="balance"><?=number_format($line['total'],0);?></td>
		</tr>
	<?php endforeach; ?>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td class="balance">Total Amount</td>
			<td class="balance"><?=number_format($total,0);?></td>
		</tr>
	</table>
</div>
<br clear="all">
<?php include "signaturesreceipt.php"?>
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>