<html>
<head><title>Delivery Order</title>
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

	<h1>Delivery Order</h1>
</div>


<?php
$this->db->where("id", $id);
$q = $this->db->get("deliveryorder");

$deliveryorder = $q->row_array();

$this->db->where("deliveryorder_id", $id);
$q = $this->db->get("deliveryorderline");

$deliveryorderline = $q->result_array();

//get warehouse detail 
$this->db->where("id", $deliveryorder['warehouse_id']);
$q = $this->db->get("warehouse");

$warehouse = $q->row_array();


//print_r($deliveryorder);
//echo "<br>";
//print_r($deliveryorderline);

?>

<div class="nomor2">
	<table>
	<tr><td>No:</td><td><?=$deliveryorder['orderid'];?></td></tr>
	<tr><td>Date:</td><td> <?=$deliveryorder['date'];?></td></tr>
	<tr><td>From Warehouse:</td><td> <?=$warehouse['name'];?></td></tr>
	<tr><td>Vehicle No:</td><td> <?=$deliveryorder['vehicleno'];?></td></tr>
	</table>
</div>


<div class="linelist">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<th>No.</th>
			<th>Deskripsi</th>
			<th>Qty</th>
			<th>Satuan</th>
		</tr>
	<?php $counter = 1; $total=0;?>
	<?php foreach($deliveryorderline as $line): ?>
		<tr>
			<td><?=$counter;?></td>
			<?php //get salesorderline, item details  & uom
				$this->db->where("id", $line['salesorderline_id']);
				$q = $this->db->get("salesorderline");

				$salesorderline = $q->row_array();
			
				$this->db->where("id", $salesorderline['item_id']);
				$q = $this->db->get("item");

				$item = $q->row_array();
			
				$this->db->where("id", $salesorderline['uom_id']);
				$q = $this->db->get("uom");

				$uom = $q->row_array();
				
				$counter++;
				$total += $salesorderline['subtotal'];
			?>
			<td><?=$item['name'];?></td>
			<td class="balance"><?=number_format($line['quantitytosend'],0);?></td>
			<td><?=$uom['name'];?></td>
		</tr>
	<?php endforeach; ?>
		
	</table>
	<div class="note">
	Remarks: <br/><br/>
	<?=$deliveryorder['orderid'];?>
	</div>
</div>
<br clear="all">
<?php include "signatures.php"?>
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>