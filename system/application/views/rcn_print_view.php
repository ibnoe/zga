<html>
<head><title>Roller Collection Note</title>
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

	<h1>Roller Collection Note</h1>
	<br clear="all">
</div>


<?php
$this->db->where("id", $id);
$q = $this->db->get("rcn");

$rcn = $q->row_array();

$this->db->where("rcn_id", $id);
$q = $this->db->get("rcnline");

$rcnline = $q->result_array();

$this->db->where('rcn_id', 1);
$q = $this->db->get("salesorderline");

$salesorderline = $q->row_array();

$this->db->where('id', $rcn['customer_id']);
$q = $this->db->get("customer");

$customer = $q->row_array();


//print_r($rcn);
//echo "<br>";
//print_r($rcnline);

?>


<div id="heading">
	<ul>
		<li>
			<table  cellspacing="0" cellpadding="0">
				<tr><td><b>P.O. No.</b></td><td><?=$rcn['customerponumber'];?></td></tr>
				<tr><td><b>Date</b></td><td> <?=$rcn['datercn'];?></td></tr>
				<tr><td><b>Customer</b></td><td> <?=$customer['firstname'];?>&nbsp;<?=$customer['lastname'];?></td></tr>
				<tr><td><b>Address</b></td><td> <?=$customer['address'];?></td></tr>
			</table>
		</li>
		<li>
			<table cellspacing="0" cellpadding="0">
			<tr><td><b>Requirements</b></td><td>&nbsp;</td></tr>
			<tr><td>Roller to recover (see inks)</td><td>
				<?php if($rcn['reqtorecover']==1): ?>
					<img src="<?=base_url();?>/css/images/tick.png"/>
				<?php endif; ?>
				</td>
			</tr>
			<tr><td>Exchange core to return</td><td>
				<?php if($rcn['reqcoretoreturn']==1): ?>
					<img src="<?=base_url();?>/css/images/tick.png"/>
				<?php endif; ?>
				</td>
			</tr>
			<tr><td>Roller return unused</td><td>
				<?php if($rcn['reqreturnunused']==1): ?>
					<img src="<?=base_url();?>/css/images/tick.png"/>
				<?php endif; ?>
				</td>
			</tr>	
			<tr><td>Roller returned faulty</td><td>
				<?php if($rcn['reqreturnfaulty']==1): ?>
					<img src="<?=base_url();?>/css/images/tick.png"/>
				<?php endif; ?>
				</td>
			</tr>
			<tr><td>Others</td><td>
				<?php if($rcn['reqothers']==1): ?>
					<img src="<?=base_url();?>/css/images/tick.png"/>
				<?php endif; ?>
				</td>
			</tr>
			</table>
		</li>
		<li>
			<table cellspacing="0" cellpadding="0">
				<tr><td><b>Inks</b></td></tr>
				<tr><td>Standard</td></tr>
				<tr><td>Mix</td></tr>
				<tr><td>UV</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td>&nbsp;</td></tr>
			</table>
		</li>
		<li>
			<table cellspacing="0" cellpadding="0">
				<tr><td><b>Notes:</b></td></tr>
				<tr><td><?=$rcn['notes'];?></td></tr>
			</table>
		</li>
	</ul>
</div>
<br/>
<div class="linelist">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<th>No.</th>
			<th>Qty</th>
			<th>Pos</th>
			<th>RD</th>
			<th>CD</th>
			<th>RL</th>
			<th>WL</th>
			<th>TL</th>
			<th>Compound</th>
			<th>Acc fitted</th>
			<th>Press &amp; Roller Type</th>
			<th>Item No.</th>
		</tr>
	<?php $counter = 1;?>
	<?php foreach($rcnline as $line): ?>
		<tr>
			<td><?=$counter;?></td>
			<?php $counter++; ?>
			<td class="balance"><?=number_format($line['quantity'],0);?></td>
			<td><?=$line['pos'];?></td>
			<td class="balance"><?=number_format($line['rd'],0);?></td>
			<td class="balance"><?=number_format($line['cd'],0);?></td>
			<td class="balance"><?=number_format($line['rl'],0);?></td>
			<td class="balance"><?=number_format($line['wl'],0);?></td>
			<td class="balance"><?=number_format($line['tl'],0);?></td>
			<?php //get compound detail
				$this->db->where('id',$line['compound_id']);
				$q = $this->db->get('item');
				$compound = $q->row_array(); 
			?>
			<td><?=$compound['name'];?></td>
			<?php if($line['accfitted'] == 1): ?>
				<td>Yes</td>
			<?php else: ?>
				<td>No</td>
			<?php endif; ?>
			<?php //get item detail: for press & roller type
				$this->db->where('id',$line['core_id']);
				$q = $this->db->get('item');
				$item = $q->row_array(); 
			?>
			<td><?=$item['pressntype'];?></td>
			<td><?=$item['idstring'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<br><br><br><br>
	<table>
	<tr>
			<td colspan="3"><b>Total Rollers Collected</b></td>
			<td colspan="3"><?=number_format($rcn['totalrollerscollected'],0);?></td>
			<td colspan="3"><b>PT Zentrum Graphics Asia: ...............................</b></td>
			<td colspan="3"><b>Agreed By Customer: ...............................</b></td>
		</tr>
	</table>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>