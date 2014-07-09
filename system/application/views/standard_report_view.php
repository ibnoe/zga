
<?php //print_r($alignment); ?>

<table width="100%">

<?php $i=0; ?>
<?php foreach ($headers as $v): ?>
	<th align="<?=$alignment[$i++];?>"><?=$v;?></th>
<?php endforeach; ?>

<?php foreach ($rows as $row): ?>
	<tr>
	<?php $i=0; ?>
	<?php foreach ($row as $col): ?>
		<td align="<?=$alignment[$i++];?>"><?=$col;?></td>
	<?php endforeach; ?>
	</tr>
<?php endforeach; ?>

</table>
