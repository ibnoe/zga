<html>
<head><title>Laporan Penjualan Bulanan</title>
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

	<h1>Laporan Penjualan Bulanan</h1>
	<h3>Periode <?=$beginningdate;?> to <?=$endingdate;?></h3>
</div>


<?php 

$this->db->from('currency');
$this->db->select('currency.*');
$q = $this->db->get();
foreach ($q->result() as $row)
{
	$currency_arr[$row->id] = $row->name;
}

$currency_arr = array('' => '');

?>

	<?php foreach ($currency_arr as $currency_id=>$currency_name): ?>

<div class="linelist">

<h3><?=$currency_name;?></h3>

<?php
$headers = array(
'salesorderline__orderid' => 'Order No',
'salesorderline__date' => 'Date',
'customer__firstname' => 'Customer',
'item__name' => 'Item',
'uom__name' => 'Unit',
'salesorderline__price' => 'Price',
'deliveryorderline__orderid' => 'Del Order No',
'deliveryorderline__date' => 'Del Date',
'warehouse__name' => 'Warehouse',
'deliveryorderline__quantitytosend' => 'Qty',
'salesreturnorderline__quantitytoreceive' => 'Qty Returned',
);

$alwaysshow = array(
'salesreturnorderline__quantitytoreceive',
'deliveryorderline__quantitytosend',
'warehouse__name',
/*'item__name',
'uom__name',
'customer__firstname',*/

);

?>

	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th>No.</th>
			<?php foreach ($headers as $k=>$v): ?>
				<th><?=$v;?></th>
			<?php endforeach; ?>
			<th></th>
		</tr>
		
		<?php

//$this->db->where('salesorder.currency_id', $currency_id);
$this->db->from('salesorder');
$this->db->join('salesorderline', 'salesorderline.salesorder_id = salesorder.id');
$this->db->join('customer', 'customer.id = salesorderline.customer_id');
$this->db->join('item', 'item.id = salesorderline.item_id');
$this->db->join('uom', 'uom.id = salesorderline.uom_id');
$this->db->join('deliveryorderline', 'salesorderline.id = deliveryorderline.salesorderline_id');
$this->db->join('warehouse', 'warehouse.id = salesorderline.warehouse_id');
$this->db->join('deliveryorder', 'deliveryorder.id = deliveryorderline.deliveryorder_id');
$this->db->join('salesinvoice', 'deliveryorder.id = salesinvoice.deliveryorder_id');
$this->db->join('salespaymentline', 'salesinvoice.id = salespaymentline.salesinvoice_id');
//$this->db->join('salesreturnorderline', 'deliveryorderline.id = salesreturnorderline.deliveryorderline_id', 'left');
$this->db->join('salesreturnorderline', 'deliveryorderline.id = salesreturnorderline.deliveryorderline_id');
$this->db->select('salesorderline.orderid as salesorderline__orderid');
$this->db->select('salesorderline.date as salesorderline__date');
$this->db->select('customer.firstname as customer__firstname');
$this->db->select('item.name as item__name');
$this->db->select('salesorderline.quantity as salesorderline__quantity');
$this->db->select('uom.name as uom__name');
$this->db->select('salesorderline.price as salesorderline__price');
$this->db->select('deliveryorderline.orderid as deliveryorderline__orderid');
$this->db->select('deliveryorderline.date as deliveryorderline__date');
$this->db->select('warehouse.name as warehouse__name');
$this->db->select('deliveryorderline.quantitytosend as deliveryorderline__quantitytosend');
$this->db->select('salesreturnorderline.quantitytoreceive as salesreturnorderline__quantitytoreceive');
$q = $this->db->get();

$counter = 1;

foreach ($q->result_array() as $row):?>

	<tr>
	<td><?=$counter;?></td>
	<?php foreach ($headers as $k=>$v): ?>
		<td>
		<?php
		
		if (true && (in_array($k, $alwaysshow) || $counter == 1))
		{
			echo $row[$k];
		}
		else if ($prevrow[$k] != $row[$k])
				echo $row[$k];
		
			
		?>
		</td>
	<?php endforeach; ?>
	
	<?php
		$prevrow = $row;
		$counter++;
	?>
	
	</tr>
<?php endforeach; ?>

	</table>
	
	<br><br>
	
<?php endforeach; ?>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>
