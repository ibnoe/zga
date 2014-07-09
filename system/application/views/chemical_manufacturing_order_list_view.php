<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		$('.hidden').hide();
		$('input:reset').button();
		$('input:button').button();
		$('input:submit').button();
		$('input:text').addClass("text ui-widget-content ui-corner-all");
		
		$('form table.main td a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		
		
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#chemical_manufacturing_orderlist',
					success: 		chemical_manufacturing_ordershowResponse,
		}; 
		
		$('#chemical_manufacturing_orderlistform').submit(function() { 
			$('#chemical_manufacturing_orderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function chemical_manufacturing_orderconfirmdelete(delid, obj)
	{
		$('#chemical_manufacturing_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', chemical_manufacturing_orderconfirmdelete2(delid, obj));
	}
	
	function chemical_manufacturing_orderconfirmdelete2(delid, obj)
	{
		$( "#chemical_manufacturing_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					chemical_manufacturing_ordercalldeletefn('chemical_manufacturing_orderdelete', delid, 'chemical_manufacturing_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#chemical_manufacturing_order-dialog-confirm').html('');
	}
	
	function chemical_manufacturing_ordersortupdown(field, direction)
	{
		$("#chemical_manufacturing_ordercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#chemical_manufacturing_orderlist',
					success: 		chemical_manufacturing_ordershowResponse,
		}; 
		$('#chemical_manufacturing_orderlistform').ajaxSubmit(options);
		return false;
	}
	
	function chemical_manufacturing_ordershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#chemical_manufacturing_orderlist',
					success: 		chemical_manufacturing_ordershowResponse,
		}; 
		
		$('#chemical_manufacturing_orderlistform').submit(function() { 
			$('#chemical_manufacturing_orderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function chemical_manufacturing_ordercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function chemical_manufacturing_orderadd()
	{
		$('#chemical_manufacturing_orderformholder').load('<?=site_url()."/chemical_manufacturing_orderadd/";?>', function()
		{$('#chemical_manufacturing_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemical_manufacturing_orderformholder' + '\').html(\'\');' + '$(\'' + '#chemical_manufacturing_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#chemical_manufacturing_orderlist' + '\').load(\'<?=site_url();?>/chemical_manufacturing_orderlist\');' + ';"></input>');
		});	
	}
	
	function chemical_manufacturing_orderedit(id)
	{
		$('#chemical_manufacturing_orderformholder').load('<?=site_url()."/chemical_manufacturing_orderedit/index/";?>' + id, function()
		{$('#chemical_manufacturing_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemical_manufacturing_orderformholder' + '\').html(\'\');' + '$(\'' + '#chemical_manufacturing_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#chemical_manufacturing_orderlist' + '\').load(\'<?=site_url();?>/chemical_manufacturing_orderlist\');' + ';"></input>');
		});	
	}
	
	function chemical_manufacturing_orderview(id)
	{
		$('#chemical_manufacturing_orderformholder').load('<?=site_url()."/chemical_manufacturing_orderview/index/";?>' + id, function()
		{$('#chemical_manufacturing_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#chemical_manufacturing_orderformholder' + '\').html(\'\');' + '$(\'' + '#chemical_manufacturing_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#chemical_manufacturing_orderlist' + '\').load(\'<?=site_url();?>/chemical_manufacturing_orderlist\');' + ';"></input>');
		});	
	}
	
	function chemical_manufacturing_ordergotopage()
	{
		var page = document.chemical_manufacturing_orderlistform.pageno.options[document.chemical_manufacturing_orderlistform.pageno.selectedIndex].value;
		
		$("#chemical_manufacturing_ordercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#chemical_manufacturing_orderlist',
					success: 		chemical_manufacturing_ordershowResponse,
		}; 
		$('#chemical_manufacturing_orderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="chemical_manufacturing_order-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="chemical_manufacturing_orderclosebutton"></div>
		<div id="chemical_manufacturing_orderformholder"></div>
		<div id="chemical_manufacturing_orderlist">
		<!--<form method="post" action="<?=site_url();?>/chemical_manufacturing_orderlist/index/" id="chemical_manufacturing_orderlistform" name="chemical_manufacturing_orderlistform">-->
		<form method="post" action="<?=current_url();?>" id="chemical_manufacturing_orderlistform" name="chemical_manufacturing_orderlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="chemical_manufacturing_ordercurrsort">
			</div>
			<div id="chemical_manufacturing_ordersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="chemical_manufacturing_orderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/chemical_manufacturing_orderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/chemical_manufacturing_orderadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				<th></th>
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="chemical_manufacturing_ordersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="chemical_manufacturing_ordersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="chemical_manufacturing_ordersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="chemical_manufacturing_ordersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
							<?php endif; ?>
						<?php } ?>
					</th>
				<?php endforeach; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				<?php if (false): ?>
					<th></th>
				<?php endif; ?>
				</tr>

				
				<?php foreach ($rows as $row): ?>
					<tr>
					
					<td><a href="<?=base_url().'index.php/chemical_manufacturing_orderview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('chemical_manufacturing_orderview/index/'.$row['id'], $row['manufacturingorder__idstring']);?></td><td><?=$row['manufacturingorder__date'];?></td><td><?php if (isset($row['manufacturingorder__penambahanstockchemical_id']) && $row['penambahanstockchemical__idstring'] != "") echo anchor('penambahan_stock_chemicalview/index/'.$row['manufacturingorder__penambahanstockchemical_id'], $row['penambahanstockchemical__idstring']);?></td><td><?php if (isset($row['manufacturingorder__item_id']) && $row['item__name'] != "") echo anchor('manufactured_itemview/index/'.$row['manufacturingorder__item_id'], $row['item__name']);?></td><td><?php if (isset($row['manufacturingorder__from_warehouse_id']) && $row['warehouse__name'] != "") echo anchor('from_warehouseview/index/'.$row['manufacturingorder__from_warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['manufacturingorder__to_warehouse_id']) && $row['warehouse1__name'] != "") echo anchor('to_warehouseview/index/'.$row['manufacturingorder__to_warehouse_id'], $row['warehouse1__name']);?></td><td><?php if (isset($row['manufacturingorder__bom_id']) && $row['bom__name'] != "") echo anchor('bill_of_materialview/index/'.$row['manufacturingorder__bom_id'], $row['bom__name']);?></td><td align='right'><?=number_format($row['manufacturingorder__quantity'], 2);?></td><td><?php if (isset($row['manufacturingorder__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['manufacturingorder__uom_id'], $row['uom__name']);?></td><td><?=$row['manufacturingorder__lastupdate'];?></td><td><?=$row['manufacturingorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="chemical_manufacturing_orderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/chemical_manufacturing_orderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="chemical_manufacturing_orderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/chemical_manufacturing_orderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="chemical_manufacturing_orderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="chemical_manufacturing_ordergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>