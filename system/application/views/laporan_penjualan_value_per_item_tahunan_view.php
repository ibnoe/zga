<html>
<head><title>Laporan Penjualan Value Per Item Tahunan | tahun <?=$year;?></title>
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

	<h1>Laporan Penjualan Value Per Item Tahunan</h1>
	<h3>Untuk Tahun <?=$year;?></h3>
</div>


<?php 

$this->db->from('itemcategory');
$this->db->select('itemcategory.*');
$q = $this->db->get();
foreach ($q->result() as $row)
{
	$itemcategory_arr[$row->id] = $row->name;
}

$col_arr = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
				7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');


?>

<div class="linelist">

	<?php foreach ($itemcategory_arr as $itemcategory_id=>$itemcategory_name): ?>

    <?php
	
	$row_arr = array();
$this->db->from('item');

$this->db->where('itemcategory_id', $itemcategory_id);
$q = $this->db->get();
foreach ($q->result() as $row)
{
	$row_arr[$row->id] = $row->name;
}

	
	?>

	<h3><?=$itemcategory_name;?></h3>
	<table cellspacing="0" cellpadding="0" class="invoice">
		<tr>
			<th></th>
			<?php foreach ($col_arr as $k=>$v): ?>
				<th><?=$v;?></th>
			<?php endforeach; ?>
			<th></th>
		</tr>
	<?php $tcol = array(); $gt = 0; ?>
	<?php foreach ($col_arr as $k=>$v): ?>
		<?php $tcol[$k] = 0; ?>
	<?php endforeach; ?>
	<?php foreach ($row_arr as $item_id=>$v): ?>
		<tr>
		<td><?=$v;?></td>
		<?php $trow = 0; ?>
		<?php foreach ($col_arr as $month=>$v): ?>
			<td>
			<?php
			{
				$total = 0;

                

                $this->db->from('salesorder');
                $this->db->join('salesorderline', 'salesorderline.salesorder_id = salesorder.id');
                $this->db->join('item', 'salesorderline.item_id = item.id');
                $this->db->join('uom', 'salesorderline.uom_id = uom.id');
                $this->db->select('uom.multiplier');
                $this->db->select('salesorderline.*');
                $this->db->select('item.itemcategory_id');
                $q = $this->db->get();

				foreach ($q->result() as $row)
				{
					if ($row->itemcategory_id == $itemcategory_id)
						if ($row->item_id == $item_id)
						{
							$date = $row->date;
							$datearr = explode('-', $date);
							$y = $datearr[0];
							$m = (int)$datearr[1];
							
							if ($year == $y)
							{
								if ($m == $month)
								{
									$total += $row->quantity * $row->price;
								}
							}
						}
				}


			}
			$x = $total;
			$tcol[$month] += $x;
			$trow += $x;
			echo number_format($x, 0);
			?>
			</td>
		<?php endforeach; ?>
		<td>
		<?php
		$gt += $trow;
		echo number_format($trow, 0);
		?>
		</td>
		</tr>
	<?php endforeach; ?>
	<tr>
	<td></td>
	<?php foreach ($col_arr as $month=>$v): ?>
		<td><?=number_format($tcol[$month], 0);?></td>
	<?php endforeach; ?>
	<td><?=number_format($gt, 0);?></td>
	</tr>
	</table>
	
	<br><br>
	
	<?php endforeach; ?>
</div>
<br clear="all">
<?php include "footnote.php"?>
<?php include "reportfooter.php"?>
</body>
</html>
