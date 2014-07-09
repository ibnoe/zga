<html>
<head><title>Laporan Manufacturing</title>
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

	<h1>Laporan Manufacturing</h1>
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
'manufacturingorder__idstring' => 'ID', 'manufacturingorder__date' => 'Date', 'warehouse__name' => 'Warehouse', 'item__name' => 'Item', 'manufacturingorder__quantity' => 'Quantity', 'uom__name' => 'Uom', 'manufacturingorderdoneline__idstring' => 'Done ID', 'manufacturingorderdoneline__date' => 'Date', 'manufacturingorderdoneline__quantitytoprocess' => 'Quantity', 'rejectmanufacturingline__idstring' => 'Reject ID', 'rejectmanufacturingline__quantitytoprocess' => 'Quantity', 'manufacturingrejectreason__name' => 'Reason', 
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

$this->db->where('manufacturingorder.date >=', "str_to_date('".$beginningdate."', '%d-%m-%Y')", false);
                        $this->db->where('manufacturingorder.date <=', "str_to_date('".$endingdate."', '%d-%m-%Y')", false);$this->db->from('manufacturingorder');$this->db->join('item', 'item.id = manufacturingorder.item_id', 'left');$this->db->join('uom', 'uom.id = manufacturingorder.uom_id', 'left');$this->db->join('manufacturingorderdoneline', 'manufacturingorder.id = manufacturingorderdoneline.manufacturingorder_id', 'left');$this->db->join('warehouse', 'warehouse.id = manufacturingorderdoneline.warehouse_id', 'left');$this->db->join('manufacturingorderdone', 'manufacturingorderdone.id = manufacturingorderdoneline.manufacturingorderdone_id', 'left');$this->db->join('rejectmanufacturingline', 'manufacturingorderdoneline.id = rejectmanufacturingline.manufacturingorderdoneline_id', 'left');$this->db->join('rejectmanufacturing', 'rejectmanufacturing.id = rejectmanufacturingline.rejectmanufacturing_id', 'left');$this->db->join('manufacturingrejectreason', 'manufacturingrejectreason.id = rejectmanufacturing.manufacturingrejectreason_id', 'left');$this->db->select('manufacturingorder.idstring as manufacturingorder__idstring');$this->db->select('manufacturingorder.date as manufacturingorder__date');$this->db->select('warehouse.name as warehouse__name');$this->db->select('item.name as item__name');$this->db->select('manufacturingorder.quantity as manufacturingorder__quantity');$this->db->select('uom.name as uom__name');$this->db->select('manufacturingorderdoneline.idstring as manufacturingorderdoneline__idstring');$this->db->select('manufacturingorderdoneline.date as manufacturingorderdoneline__date');$this->db->select('manufacturingorderdoneline.quantitytoprocess as manufacturingorderdoneline__quantitytoprocess');$this->db->select('rejectmanufacturingline.idstring as rejectmanufacturingline__idstring');$this->db->select('rejectmanufacturingline.quantitytoprocess as rejectmanufacturingline__quantitytoprocess');$this->db->select('manufacturingrejectreason.name as manufacturingrejectreason__name');
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
