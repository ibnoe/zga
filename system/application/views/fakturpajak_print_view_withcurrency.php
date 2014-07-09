<html>
<head></head>
<body>
<br><br><br>

<style type="text/css">
	#printcont { position:relative; height: 100%; width: 100%; }
	#kodefaktur { position:absolute; left:415px; top:42px; }
	#namapt { position:absolute; left:415px; top:221px; }
	#address { position:absolute; left:415px; top:247px; }
	#npwp { position:absolute; left:415px; top:287px; }
	#description { position:absolute; left:50px; top:395px; }
	#amount { position:absolute; left:850px; top:658px; }
	#amounttimesrate { position:absolute; left:410px; top:905px; }
	#ppn { position:absolute; left:850px; top:746px; }
	#ppntimesrate { position:absolute; left:325px; top:925px; }
	#date { position:absolute; left:900px; top:787px; }
	#currencyrate { position:absolute; left:285px; top:905px; }
	#strikethrough { position:absolute; left: 150px; top: 658px; }
	#invoiceno { position:absolute; left: 100px; top: 630px; }
	#dasarpengenaanpajak { position:absolute; left: 850px; top: 630px; }
</style>
<?php
$this->db->where("id", 6);
$q = $this->db->get("salesinvoice");

$salesinvoice = $q->row_array();

$this->db->where("salesinvoice_id", 6);
$q = $this->db->get("salesinvoiceline");

$salesinvoiceline = $q->result_array();

$this->db->where("id", $salesinvoice['customer_id']);
$q = $this->db->get("customer");
$customer = $q->row_array();

?>
<div id="kodefaktur">
<?=$salesinvoice['orderid'];?>
</div>

<div id="namapt">
<?=$customer['firstname'];?> &nbsp; <?=$customer['lastname'];?>
</div>
<div id="address">
<?=$customer['address'];?>
</div>
<div id="npwp">
<?=$customer['npwp'];?>
</div>
<div id="description">
<?php $no = 1; $total=0;?>
<table cellpadding="0" cellspacing="0">
<?php foreach ($salesinvoiceline as $line): ?>
	<tr>
	<td width="52"><?=$no++;?></td>
	<td width="33" align="right"><?=$line['quantity'];?></td>
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
				
				$total += $line['subtotal'];
	?>
	
	<td width="500"><?=$item['name'];?><?=$uom['name'];?></td>
	<td width="32">@</td>
	<td width="218"><?=$line['price'];?></td>
	<td width="261"><?=$line['price']*$line['quantity'];?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div id="invoiceno">
<?=$salesinvoice['orderid'];?>
</div>
<div id="strikethrough">
xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
</div>
<div id="amount">
<?=number_format($salesinvoice['grandtotal'],0);?>
</div>
<div id="amounttimesrate">
<?php if (isset($salesinvoice['currencyrate'])) echo $salesinvoice['grandtotal'] * $salesinvoice['currencyrate']; ?>
</div>

<div id="dasarpengenaanpajak">
<?=$salesinvoice['grandtotal'];?>
</div>
<div id="ppn">
<?=$salesinvoice['grandtotal'] * 0.1;?>
</div>
<div id="ppntimesrate">
<?php if (isset($salesinvoice['currencyrate'])) echo $salesinvoice['grandtotal'] * 0.1 * $salesinvoice['currencyrate']; ?>
</div>

<div id="date">
Jakarta, <?=date('j F Y');?>
</div>

<div id="currencyrate">
<?php if (isset($salesinvoice['currencyrate'])) echo $salesinvoice['currencyrate']; ?>
</div>

<div class="content" style="page-break-after:always">
</div>
</body>
</html>