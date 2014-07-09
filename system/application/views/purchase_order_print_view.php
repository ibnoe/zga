<html>
<head><title>Purchase Order</title>
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

	<h1>PURCHASE ORDER</h1>



<?php
$this->db->where("id", $id);
$q = $this->db->get("purchaseorder");

$purchaseorder = $q->row_array();

$this->db->where("purchaseorder_id", $id);
$q = $this->db->get("purchaseorderline");

$purchaseorderline = $q->result_array();

//print_r($purchaseorder);
//echo "<br>";
//print_r($purchaseorderline);

$this->db->where("id", $purchaseorder['supplier_id']);
$q = $this->db->get("supplier");

$supplier = $q->row_array();

$this->db->where("id", $purchaseorder['currency_id']);
$q = $this->db->get("currency");

$currency = $q->row_array();

?>
	<h4>To:<br/> <span class="indented">
		<?php if($supplier['company']!= null && $supplier['company'] != ""): ?>
			<?=$supplier['company'];?>
		<?php else: ?>
			<?=$supplier['firstname'];?>&nbsp;<?=$supplier['lastname'];?>
		<?php endif; ?>
	</span><br/>
	<span class="indented"><?=$supplier['address'];?></span><br/>
	<span class="indented">Telp. <?=$supplier['phone'];?> Fax. <?=$supplier['fax'];?><br/></span></h4>
	<h4>Attn: <?=$supplier['contactperson'];?></h4>
</div>
<div id="heading2">
	<ul>
		<li>
			<table cellspacing="0" cellpadding="0">
				<tr><td>Deliver to:</td><td><?=$supplier['address'];?></td></tr>
			</table>
			<table cellspacing="0" cellpadding="0">
				<tr><td>Terms:</td><td><?=$purchaseorder['shipmethod'];?></td></tr>
				<!--<tr><td>Delivery Date:<?=$purchaseorder['address'];?></td></tr>-->
			</table>
			<table cellspacing="0" cellpadding="0">
				<tr><td>P.O. No:</td><td><?=$purchaseorder['orderid'];?></td></tr>
				<tr><td>Date:</td><td> <?=$purchaseorder['date'];?></td></tr>
				<tr><td>Currency:</td><td> <?=$currency['name'];?></td></tr>
				<tr><td>Ex. Rate:</td><td> 
					<?php if($purchaseorder['currencyrate'] == 1): ?>
						-
					<?php else: ?>
						<?=$purchaseorder['currencyrate'];?>
					<?php endif; ?>
				</td></tr>
			</table>
		</li>
	</ul>
	<p>We are pleased to order the following items:</p>
</div>


<div class="linelist">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<th>No.</th>
			<th>Items</th>
			<th>Qty</th>
			<th>UoM</th>
			<th>Unit Price</th>
			<th>Amount</th>
		</tr>
	<?php $counter = 1; $total=0;?>
	<?php foreach($purchaseorderline as $line): ?>
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
			<td class="balance"><?=number_format($line['subtotal'],0);?></td>
		</tr>
	<?php endforeach; ?>
		<tr>
			<td class="total" colspan="5">Total</td>
			<td class="total"><?=$currency['name'];?>&nbsp;<?=number_format($total,0);?></td>
		</tr>
	</table>
	<p>Remarks:<br>
	- Please check, sign and fax to PT ZGA</p>
</div>
<br clear="all">
<div class="signatures">
<table>
	<tr>
		<td>PT Zentrum Graphics Asia</td>
		<td>Agreed by vendor,</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td><span>Authorized Signatory</span></td>
		<td><span>Signature, Name &amp; Stamp</span></td>
	</tr>
</table>
</div>
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>