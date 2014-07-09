<html>
<head><title>Laporan Pembelian Bulanan</title>
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

	<h1>Laporan Pembelian Bulanan</h1>
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
'purchaseorder__orderid' => 'Order ID', 'purchaseorder__date' => 'Date', 'supplier__firstname' => 'Supplier', 'item__name' => 'Item', 'purchaseorderline__quantity' => 'Quantity', 'uom__name' => 'Uom', 'purchaseorderline__price' => 'Price', 'receiveditemline__orderid' => 'Received ID', 'receiveditemline__date' => 'Date', 'warehouse__name' => 'Warehouse', 'receiveditemline__quantitytoreceive' => 'Quantity', 
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

$this->db->where('purchaseorder.date >=', "str_to_date('".$beginningdate."', '%d-%m-%Y')", false);
                        $this->db->where('purchaseorder.date <=', "str_to_date('".$endingdate."', '%d-%m-%Y')", false);$this->db->from('purchaseorder');$this->db->join('supplier', 'supplier.id = purchaseorder.supplier_id', 'left');$this->db->join('purchaseorderline', 'purchaseorder.id = purchaseorderline.purchaseorder_id', 'left');$this->db->join('item', 'item.id = purchaseorderline.item_id', 'left');$this->db->join('warehouse', 'warehouse.id = purchaseorderline.warehouse_id', 'left');$this->db->join('uom', 'uom.id = purchaseorderline.uom_id', 'left');$this->db->join('receiveditemline', 'purchaseorderline.id = receiveditemline.purchaseorderline_id', 'left');$this->db->join('receiveditem', 'receiveditem.id = receiveditemline.receiveditem_id', 'left');$this->db->join('purchaseinvoice', 'receiveditem.id = purchaseinvoice.receiveditem_id', 'left');$this->db->join('purchasepaymentline', 'purchaseinvoice.id = purchasepaymentline.purchaseinvoice_id', 'left');$this->db->select('purchaseorder.orderid as purchaseorder__orderid');$this->db->select('purchaseorder.date as purchaseorder__date');$this->db->select('supplier.firstname as supplier__firstname');$this->db->select('item.name as item__name');$this->db->select('purchaseorderline.quantity as purchaseorderline__quantity');$this->db->select('uom.name as uom__name');$this->db->select('purchaseorderline.price as purchaseorderline__price');$this->db->select('receiveditemline.orderid as receiveditemline__orderid');$this->db->select('receiveditemline.date as receiveditemline__date');$this->db->select('warehouse.name as warehouse__name');$this->db->select('receiveditemline.quantitytoreceive as receiveditemline__quantitytoreceive');
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
