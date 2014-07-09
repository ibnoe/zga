<html>
<head><title>IDENTIFICATION OF INCOMING ROLLERS </title>
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

	<h1>IDENTIFICATION OF INCOMING ROLLERS</h1>
	<br clear="all">
</div>


<?php
$this->db->where("id", 2);
$q = $this->db->get("rcn");

$rif = $q->row_array();

$this->db->where("rcn_id", 2);
$q = $this->db->get("rcnline");

$rifline = $q->result_array();

/*$this->db->where('rcn_id', 1);
$q = $this->db->get("salesorderline");

$salesorderline = $q->row_array();
*/
$this->db->where('id', $rif['customer_id']);
$q = $this->db->get("customer");

$customer = $q->row_array();


//print_r($rcn);
//echo "<br>";
//print_r($rcnline);

?>


<div id="heading2">
	<ul>
		<li>
			<table  cellspacing="0" cellpadding="0">
				<tr><td><b>Date/Time of Incoming Roll</b></td><td> <?=$rif['incomingrolldate'];?>/<?=$rif['incomingrolltime'];?></td></tr>
				<tr><td><b>Date/Time of Identification</b></td><td> <?=$rif['identificationdate'];?>/<?=$rif['identificationtime'];?></td></tr>
			</table>
		</li>
		<li>
			<table cellspacing="0" cellpadding="0">
			<tr><td><b>Customer</b></td><td><?=$customer['firstname'];?>&nbsp;<?=$customer['lastname'];?></td></tr>
			<tr><td><b>Press</b></td><td><?=$rif['press'];?></td></tr>
			
			</table>
		</li>
		
		<li>
			<table cellspacing="0" cellpadding="0">
				<tr><td><b>No. Diss:</b></td></tr>
				<tr><td><?=$rif['nodiss'];?></td></tr>
			</table>
		</li>
	</ul>
</div>
<br/>
<div class="linelist">
	<table cellspacing="0" cellpadding="0" class="bordered">
		<tr>
			<td rowspan="2"><b>ID<br/>No</b></td>
			<td rowspan="2"><b>Machine/Specification</b></td>
			<td rowspan="2"><b>Roller No.</b></td>
			<td colspan="5"><b>Dimensions (mm)</b></td>
			<td colspan="2"><b>Core Type</b></td>
			<td><b>Acc</b></td>
			<td rowspan="2"><b>Repair Request</b></td>
			<td rowspan="2"><b>Remarks</b></td>
		</tr>
		<tr>
			<td><b>RD</b></td>
			<td><b>CD</b></td>
			<td><b>RL</b></td>
			<td><b>WL</b></td>
			<td><b>TL</b></td>
			<!--<td><b>Groove Length</b></td>
			<td><b>Qty of Grooves</b></td>-->
			<td><b>R</b></td>
			<td><b>Z</b></td>
			<td><b>Y/N</b></td>
		</tr>
	<?php $counter = 1;?>
	<?php foreach($rifline as $line): ?>
		<tr>
			<td><?=$counter;?></td>
			<?php $counter++; ?>
			<td><?=number_format($line['machinespec'],0);?></td>
			<td>roll id</td>
			<td class="balance"><?=number_format($line['rd'],0);?></td>
			<td class="balance"><?=number_format($line['cd'],0);?></td>
			<td class="balance"><?=number_format($line['rl'],0);?></td>
			<td class="balance"><?=number_format($line['wl'],0);?></td>
			<td class="balance"><?=number_format($line['tl'],0);?></td>
			<?php if($line['coretype'] == "Y"): ?>
				<td><img src="<?=base_url();?>/css/images/tick.png"/></td>
				<td>&nbsp;</td>
			<?php else: ?>
				<td>&nbsp;</td>
				<td><img src="<?=base_url();?>/css/images/tick.png"/></td>
			<?php endif; ?>
			<?php if($line['accfitted'] == 1): ?>
				<td>Y</td>
			<?php else: ?>
				<td>N</td>
			<?php endif; ?>
			<td>
				<?php if($line['repairrequest'] == "" || $line['repairrequest'] == null) : ?>
					-
				<?php else: ?>	
					<?=$line['repairrequest'];?></td>
				<?php endif; ?>
			<td><?php if($line['remarks'] == "" || $line['remarks'] == null) : ?>
					-
				<?php else: ?>	
					<?=$line['remarks'];?></td>
				<?php endif; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<br><br><br><br>
	<table class="signatures">
		<tr>
			<td>Inspector,</td>
			<td>Checked by,</td>
			<td>Given by,</td>
			<td>Received by,</td>
		</tr>
		<tr><td colspan="4">&nbsp;</td></tr>
		<tr><td colspan="4">&nbsp;</td></tr>
		<tr><td colspan="4">&nbsp;</td></tr>
		<tr>
			<td>....................</td>
			<td>....................</td>
			<td>....................</td>
			<td>....................</td>
		</tr>
	</table>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>