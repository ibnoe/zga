<html>
<head></head>
<body>

<br><br><br>

<style type="text/css">
	#page { height: 1119px; }
	#printcont { position:relative; height: 100%; width: 100%; }
	#kodefaktur { position:absolute; left:242px; top:70px; font-size:12px;}
	#namapt1 { position:absolute; left:242px; top:151px; font-size:12px; }
	#address1 { position:absolute; left:242px; top:166px; font-size:12px; }
	#npwp1 { position:absolute; left:242px; top:193px; font-size:12px; }
	
	#namapt2 { position:absolute; left:242px; top:265px;  font-size:12px;}
	#address2 { position:absolute; left:242px; top:283px; font-size:12px; }
	#npwp2 { position:absolute; left:242px; top:310px; font-size:12px; }
	
	
	#description { position:absolute; left:50px; top:386px;}
	#description table td { font-size:12px; }
	
	#date { position:absolute; left:499px; top:870px; font-size:12px;}
	
	#bottom { position:absolute; left: 102px; top:737px; }
	#bottom td { font-size:12px; }
	#currencyrate { position:absolute; left:106px; top:983px; font-size:12px;}
	
</style>
<?php //initializing position 
	$kodefaktur = 70;
	$namapt1 = 151;
	$address1 = 166;
	$npwp1 = 193;
	$namapt2 = 265;
	$address2 = 283;
	$npwp2 = 310;
	$description=386;
	$bottom=737;
	$currencyrate=983;
	$date=870;
?>
<?php for($i=0;$i<count($results);$i+=10): ?>
	<div id="page">
	
	<div style="position:absolute; left:242px; top:<?=$kodefaktur;?>px; font-size:12px;">
	<?=$code;?>
	</div>
	<div style="position:absolute; left:242px; top:<?=$namapt1;?>px; font-size:12px; ">
	PT Zentrum Graphics Asia
	</div>
	<div style="position:absolute; left:242px; top:<?=$address1;?>px; font-size:12px;">
	Jl. Raya Serpong KM.7 Komp Multiguna A.1/1<br/>
	Pakualam Serpong Utara Tangerang 15310 - Banten
	</div>
	<div style="position:absolute; left:242px; top:<?=$npwp1;?>px; font-size:12px; ">
	02.095.317.0-411.000
	</div>

	<div style=" position:absolute; left:242px; top:<?=$namapt2;?>px;  font-size:12px;">
	<?=$customer_detail['firstname'];?> &nbsp; <?=$customer_detail['lastname'];?>
	</div>
	<div style="position:absolute; left:242px; top:<?=$address2;?>px; font-size:12px;">
	<?=$customer_detail['address'];?>
	</div>
	<div style="position:absolute; left:242px; top:<?=$npwp2;?>px; font-size:12px; ">
	<?=$customer_detail['npwp'];?>
	</div>
	<div style="position:absolute; left:50px; top:<?=$description;?>px;">
	<?php $no = 1; $total=0;?>
	<table cellpadding="0" cellspacing="0">
	<?php //get 10 lines of results
		$this->db->from('deliveryorderline');
		$this->db->join('deliveryorder', 'deliveryorderline.deliveryorder_id = deliveryorder.id');
		$this->db->join('salesinvoice', 'salesinvoice.deliveryorder_id = deliveryorder.id');
		$this->db->where('salesinvoice.id',$invoice_id);
		$this->db->limit(10,$i);
		$q = $this->db->get();
		$lines = $q->result_array();
	
	?>
	<?php foreach ($lines as $line): ?>
		<tr>
		<td style="width:37px;font-size:12px; "><?=$no++;?></td>
		<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">
		<?php //get item details  & uom
				
					$this->db->where("id", $line['item_id']);
					$q = $this->db->get("item");

					$item = $q->row_array();
				
					$this->db->where("id", $line['uom_id']);
					$q = $this->db->get("uom");

					$uom = $q->row_array();
					
					$this->db->where("id", $line['currency_id']);
					$q = $this->db->get("currency");

					$currency = $q->row_array();
					
					$total += $line['subtotal'];
		?>
		<?=$item['name'];?> - <?=$line['quantitytosend'];?> <?=$uom['name'];?></td>
		<?php if($currency['name'] != "Rp."): ?>
			<td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> <?=$line['price'];?></td><td style="width:117px; vertical-align:top; text-align:right;">-</td>
		<?php else: ?>
			<td style="width:117px; vertical-align:top;font-size:12px; ">-</td><td  style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> <?=$line['price'];?></td>
		<?php endif; ?>
		</tr>

	<?php endforeach; ?>
	</table>
	</div>
	<table style="position:absolute; left: 102px; top:<?=$bottom;?>px;">
		<?php if($currency['name'] != "Rp."): ?>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top; font-size:12px; ">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td>
				<td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> <?=$total;?></td><td style="width:117px; vertical-align:top;font-size:12px; ">-</td>
			</tr>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">&nbsp;</td>
				<td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> 0</td><td style="width:117px; vertical-align:top;font-size:12px; ">-</td>
			</tr>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">&nbsp;</td>
				<td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> 0</td><td style="width:117px; vertical-align:top;font-size:12px; ">-</td>
			</tr>
			<?php
				$rupiah = $total * $rate;
				$ppn = $rupiah * 0.1;
			?>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">&nbsp;</td>
				<td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> <?=$total;?></td><td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$rupiah;?></td>
			</tr>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">&nbsp;</td>
				<td style="width:117px; vertical-align:top;font-size:12px; ">&nbsp;</td><td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$ppn;?></td>
			</tr>
		<?php else: ?>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; "><div id="strikethrough">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</div></td>
				<td style="width:117px; vertical-align:top;font-size:12px; ">-</td><td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> <?=$total;?></td>
			</tr>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">&nbsp;</td>
				<td style="width:117px; vertical-align:top;font-size:12px; ">-</td><td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> 0</td>
			</tr>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">&nbsp;</td>
				<td style="width:117px; vertical-align:top;font-size:12px; ">-</td><td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$currency['name'];?> 0</td>
			</tr>
			<?php
				$rupiah = $total * $rate;
				$ppn = $rupiah * 0.1;
			?>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">&nbsp;</td>
				<td style="width:117px; vertical-align:top;font-size:12px; ">-</td><td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$rupiah;?></td>
			</tr>
			<tr>
				<td style="width:491px; text-transform:uppercase; padding-right:10px; vertical-align:top;font-size:12px; ">&nbsp;</td>
				<td style="width:117px; vertical-align:top;font-size:12px; ">&nbsp;</td><td style="width:117px; vertical-align:top; text-align:right;font-size:12px; "><?=$ppn;?></td>
			</tr>
		<?php endif; ?>
	</table>



	<div style="position:absolute; left:499px; top:<?=$date;?>px; font-size:12px;">
	Tangerang <span> <?=date('j F Y');?></span>
	<br/><br/><br/><br/><br/><br/>
	Johanes Andhika Sudirman
	</div>

	<div style="position:absolute; left:106px; top:<?=$currencyrate;?>px; font-size:12px;">
	<?php if ($rate != 1) echo $rate . '  1 ' . $currency['name']; ?>
	</div>
	</div> <!--end page-->
	<?php //incrementing position
		$kodefaktur += 1119;
		$namapt1 += 1119;
		$address1 += 1119;
		$npwp1 += 1119;
		$namapt2 += 1119;
		$address2 += 1119;
		$npwp2 += 1119;
		$description+= 1119;
		$bottom+= 1119;
		$currencyrate+= 1119;
		$date+= 1119;
	?>
<?php endfor; ?>

<div class="content" style="page-break-after:always">
</div>
</body>
</html>