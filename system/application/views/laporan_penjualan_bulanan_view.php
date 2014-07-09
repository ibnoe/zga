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

$test_arr = array('' => '');

?>

	<?php foreach ($test_arr as $test_k=>$test_v): ?>

<div class="linelist">

<h3><?=$test_v;?></h3>

<?php
$headers = array(
'salesorder__orderid' => 'Order ID', 'salesorder__date' => 'Date', 'customer__firstname' => 'Customer', 'item__name' => 'Item', 'salesorderline__quantity' => 'Quantity', 'uom__name' => 'Uom', 'salesorderline__price' => 'Price', 'deliveryorderline__orderid' => 'Delivery ID', 'deliveryorderline__date' => 'Date', 'warehouse__name' => 'Warehouse', 'deliveryorderline__quantitytosend' => 'Quantity', 
);

$alwaysshow = array(
/*'salesreturnorderline__quantitytoreceive',
'deliveryorderline__quantitytosend',
'warehouse__name',
'item__name',
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

$this->db->where('salesorder.date >=', "str_to_date('".$beginningdate."', '%d-%m-%Y')", false);
                        $this->db->where('salesorder.date <=', "str_to_date('".$endingdate."', '%d-%m-%Y')", false);$this->db->from('salesorder');$this->db->join('customer', 'customer.id = salesorder.customer_id', 'left');$this->db->join('salesorderline', 'salesorder.id = salesorderline.salesorder_id', 'left');$this->db->join('item', 'item.id = salesorderline.item_id', 'left');$this->db->join('warehouse', 'warehouse.id = salesorderline.warehouse_id', 'left');$this->db->join('uom', 'uom.id = salesorderline.uom_id', 'left');$this->db->join('deliveryorderline', 'salesorderline.id = deliveryorderline.salesorderline_id', 'left');$this->db->join('deliveryorder', 'deliveryorder.id = deliveryorderline.deliveryorder_id', 'left');$this->db->join('salesinvoice', 'deliveryorder.id = salesinvoice.deliveryorder_id', 'left');$this->db->join('salespaymentline', 'salesinvoice.id = salespaymentline.salesinvoice_id', 'left');$this->db->select('salesorder.orderid as salesorder__orderid');$this->db->select('salesorder.date as salesorder__date');$this->db->select('customer.firstname as customer__firstname');$this->db->select('item.name as item__name');$this->db->select('salesorderline.quantity as salesorderline__quantity');$this->db->select('uom.name as uom__name');$this->db->select('salesorderline.price as salesorderline__price');$this->db->select('deliveryorderline.orderid as deliveryorderline__orderid');$this->db->select('deliveryorderline.date as deliveryorderline__date');$this->db->select('warehouse.name as warehouse__name');$this->db->select('deliveryorderline.quantitytosend as deliveryorderline__quantitytosend');
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
