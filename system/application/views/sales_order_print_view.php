<html>
<head><title>Sales Order</title>
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

	<h1>Sales Order</h1>
</div>


<?php
$this->db->where("id", $id);
$q = $this->db->get("salesorder");

$salesorder = $q->row_array();

$this->db->where("salesorder_id", $id);
$q = $this->db->get("salesorderline");

$salesorderline = $q->result_array();

//print_r($salesorder);
//echo "<br>";
//print_r($salesorderline);

?>

<div class="nomor2">
	<table>
	<tr><td>Nomor Sales Order:</td><td><?=$salesorder['orderid'];?></td></tr>
	<tr><td>Tanggal:</td><td> <?=$salesorder['date'];?></td></tr>
	<tr><td>Nomor Penawaran:</td><td> <?=$salesorder['nopenawaran'];?></td></tr>
	<tr><td>Nomor Purchase Order:</td><td> <?=$salesorder['customerponumber'];?></td></tr>
<?php //GET CUSTOMER DETAILS & Currency
	$this->db->where("id", $salesorder['marketingofficer_id']);
	$q = $this->db->get("marketingofficer");

	$marketingofficer = $q->row_array();
	//print_r($marketingofficer)
	
	$this->db->where("id", $salesorder['currency_id']);
	$q = $this->db->get("currency");
	$currency = $q->row_array();

?>
	<tr><td>Marketing:</td><td> <?=$marketingofficer['name'];?></td></tr>
	</table>
</div>

<?php //GET CUSTOMER DETAILS
	$this->db->where("id", $salesorder['customer_id']);
	$q = $this->db->get("customer");

	$customer = $q->row_array();
	//print_r($customer);
	
	
?>

<div class="customer">
Kepada: <br/>
<?=$customer['firstname'];?>&nbsp;<?=$customer['lastname'];?><br/>
<?php if ($customer['company']!= null): ?>
	<?=$customer['company'];?><br/>
<?php endif; ?>	
<?php if ($customer['address']!= null): ?>
	<?=$customer['address'];?><br/>
<?php endif; ?>	
<?php if ($customer['phone']!= null): ?>
	Phone: <?=$customer['phone'];?><br/>
<?php endif; ?>		
<?php if ($customer['fax']!= null): ?>
	Fax: <?=$customer['fax'];?><br/>
<?php endif; ?>	
</div>
<div class="linelist">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<th>No.</th>
			<th>Deskripsi</th>
			<th>Qty</th>
			<th>Satuan</th>
			<th>Harga Satuan (<?=$currency['name'];?>)</th>
			<th>Discount %</th>
			<th>Subtotal (<?=$currency['name'];?>)</th>
		</tr>
	<?php $counter = 1; $total=0;?>
	<?php foreach($salesorderline as $line): ?>
		<tr>
			<td><?=$counter;?></td>
			<?php //get item details  & uom
				$this->db->where("id", $line['item_id']);
				$q = $this->db->get("item");

				$item = $q->row_array();
			
				$this->db->where("id", $line['uom_id']);
				$q = $this->db->get("uom");

				$uom = $q->row_array();
				
				$counter++;
				$total += $line['subtotal'];
			?>
			<td><?=$item['name'];?></td>
			<td class="balance"><?=number_format($line['quantity'],0);?></td>
			<td><?=$uom['name'];?></td>
			<td class="balance"><?=number_format($line['price'],0);?></td>
			<td class="balance"><?=number_format($line['pdisc'],0);?></td>
			<td class="balance"><?=number_format($line['subtotal'],0);?></td>
		</tr>
	<?php endforeach; ?>
		<tr>
			<td class="total" colspan="6">Total</td>
			<td class="total"><?=$currency['name'];?>&nbsp;<?=number_format($total,0);?></td>
		</tr>
	</table>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>