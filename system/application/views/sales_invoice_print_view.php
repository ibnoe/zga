<html>
<head><title>Sales Invoice</title>
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

	<h1>Sales Invoice</h1>
</div>


<?php
$this->db->where("id", $id);
$q = $this->db->get("salesinvoice");

$salesinvoice = $q->row_array();

$this->db->where("deliveryorder_id", $salesinvoice['deliveryorder_id']);
$q = $this->db->get("deliveryorderline");

$salesinvoiceline = $q->result_array();

//print_r($salesinvoice);
//echo "<br>";
//print_r($salesinvoiceline);

?>
<?php //GET Currency Details
	
	$this->db->where("id", $salesinvoice['currency_id']);
	$q = $this->db->get("currency");
	$currency = $q->row_array();
?>

<div class="nomor2">
	<table>
	<tr><td>No:</td><td><?=$salesinvoice['orderid'];?></td></tr>
	<tr><td>Date:</td><td> <?=$salesinvoice['date'];?></td></tr>
	<!--<tr><td>Our Ref:</td><td> <?=$salesinvoice['nopenawaran'];?></td></tr>
	<tr><td>Your Ref:</td><td> <?=$salesinvoice['customerponumber'];?></td></tr>-->
	<tr><td>D.O. No:</td><td> <?=$salesinvoice['donum'];?></td></tr>
	<tr><td>Currency:</td><td> <?=$currency['name'];?></td></tr>
	
	</table>
</div>

<?php //GET CUSTOMER DETAILS
	//$this->db->where("id", $salesinvoice['customer_id']);
	//$q = $this->db->get("customer");

	//$customer = $q->row_array();
	//print_r($customer);
?>

<div class="linelist">
	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th>No.</th>
			<th>Item Code</th>
			<th>Description</th>
			<th>UOM</th>
			<th>Qty</th>
			<th>Unit Price</th>
			<th>Total Price</th>
		</tr>
	<?php $counter = 1; $total=0;?>
	<?php foreach($salesinvoiceline as $line): ?>
		<tr>
			<td><?=$counter;?></td>
			<?php //get item details  & uom
			
				$this->db->where("id", $line['salesorderline_id']);
				$q = $this->db->get("salesorderline");

				$salesorderline = $q->row_array();
			
			
				$this->db->where("id", $line['item_id']);
				$q = $this->db->get("item");

				$item = $q->row_array();
			
				$this->db->where("id", $line['uom_id']);
				$q = $this->db->get("uom");

				$uom = $q->row_array();
				
				$counter++;
				$total += $line['subtotal'];
			?>
			<td><?=$item['idstring'];?></td>
			<td><?=$item['name'];?></td>
			<td><?=$uom['name'];?></td>
			<td class="balance"><?=number_format($line['quantitytosend'],0);?></td>
			<td class="balance"><?=number_format($line['price'],0);?></td>
			<td class="balance"><?=number_format($line['subtotal'],0);?></td>
		</tr>
	<?php endforeach; ?>
		<tr><td colspan="7" class="bordered">&nbsp;</td></tr>
		<tr>
			<td>Amount:</td>
			<td colspan="4">&nbsp;</td>
			<td class="alignedleft">Gross Amount:</td>
			<td class="balance"><?=$currency['name'];?>&nbsp;<?=number_format($total,0);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="4">&nbsp;</td>
			<td class="alignedleft">Discount:</td>
			<td class="balance"><?=$currency['name'];?>&nbsp;<?=number_format($salesinvoice['totaldiscount'],0);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="4">&nbsp;</td>
			<td class="alignedleft">Taxable Amount:</td>
			<td class="balance"><?=$currency['name'];?>&nbsp;<?=number_format($total-$salesinvoice['totaldiscount'],0);?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="4">&nbsp;</td>
			<td class="alignedleft">Discount:</td>
			<td class="balance"><?=$currency['name'];?>&nbsp;<?=number_format($salesinvoice['totaltax'],0);?></td>
		</tr>
		<tr>
			<td>Term:</td>
			<td colspan="4" class="alignedleft"><?=$salesinvoice['top'];?></td>
			<td class="alignedleft">Invoice Value:</td>
			<td class="balance"><?=$currency['name'];?>&nbsp;<?=number_format($salesinvoice['grandtotal'],0);?></td>
		</tr>
	</table>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>