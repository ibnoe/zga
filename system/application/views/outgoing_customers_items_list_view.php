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
		
		$('.checkall').click(function () { $(this).parents('table.main').find(':checkbox').attr('checked', this.checked); });
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#outgoing_customers_itemslist',
					success: 		outgoing_customers_itemsshowResponse,
		}; 
		
		$('#outgoing_customers_itemslistform').submit(function() { 
			$('#outgoing_customers_itemslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function outgoing_customers_itemsconfirmdelete(delid, obj)
	{
		$('#outgoing_customers_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', outgoing_customers_itemsconfirmdelete2(delid, obj));
	}
	
	function outgoing_customers_itemsconfirmdelete2(delid, obj)
	{
		$( "#outgoing_customers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					outgoing_customers_itemscalldeletefn('outgoing_customers_itemsdelete', delid, 'outgoing_customers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#outgoing_customers_items-dialog-confirm').html('');
	}
	
	function outgoing_customers_itemssortupdown(field, direction)
	{
		$("#outgoing_customers_itemscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#outgoing_customers_itemslist',
					success: 		outgoing_customers_itemsshowResponse,
		}; 
		$('#outgoing_customers_itemslistform').ajaxSubmit(options);
		return false;
	}
	
	function outgoing_customers_itemsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#outgoing_customers_itemslist',
					success: 		outgoing_customers_itemsshowResponse,
		}; 
		
		$('#outgoing_customers_itemslistform').submit(function() { 
			$('#outgoing_customers_itemslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function outgoing_customers_itemscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function outgoing_customers_itemsadd()
	{
		$('#outgoing_customers_itemsformholder').load('<?=site_url()."/outgoing_customers_itemsadd/";?>', function()
		{$('#outgoing_customers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#outgoing_customers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#outgoing_customers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#outgoing_customers_itemslist' + '\').load(\'<?=site_url();?>/outgoing_customers_itemslist\');' + ';"></input>');
		});	
	}
	
	function outgoing_customers_itemsedit(id)
	{
		$('#outgoing_customers_itemsformholder').load('<?=site_url()."/outgoing_customers_itemsedit/index/";?>' + id, function()
		{$('#outgoing_customers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#outgoing_customers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#outgoing_customers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#outgoing_customers_itemslist' + '\').load(\'<?=site_url();?>/outgoing_customers_itemslist\');' + ';"></input>');
		});	
	}
	
	function outgoing_customers_itemsview(id)
	{
		$('#outgoing_customers_itemsformholder').load('<?=site_url()."/outgoing_customers_itemsview/index/";?>' + id, function()
		{$('#outgoing_customers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#outgoing_customers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#outgoing_customers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#outgoing_customers_itemslist' + '\').load(\'<?=site_url();?>/outgoing_customers_itemslist\');' + ';"></input>');
		});	
	}
	
	function outgoing_customers_itemsgotopage()
	{
		var page = document.outgoing_customers_itemslistform.pageno.options[document.outgoing_customers_itemslistform.pageno.selectedIndex].value;
		
		$("#outgoing_customers_itemscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#outgoing_customers_itemslist',
					success: 		outgoing_customers_itemsshowResponse,
		}; 
		$('#outgoing_customers_itemslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="outgoing_customers_items-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="outgoing_customers_itemsclosebutton"></div>
		<div id="outgoing_customers_itemsformholder"></div>
		<div id="outgoing_customers_itemslist">
		<!--<form method="post" action="<?=site_url();?>/outgoing_customers_itemslist/index/" id="outgoing_customers_itemslistform" name="outgoing_customers_itemslistform">-->
		<form method="post" action="<?=current_url();?>" id="outgoing_customers_itemslistform" name="outgoing_customers_itemslistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#customerfilter').change(function() { $('#outgoing_customers_itemslistform').submit();});});</script>Customer:&nbsp;<?=form_dropdown('customer_id', $customer_opt, $customer_id, 'id="customerfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#warehousefilter').change(function() { $('#outgoing_customers_itemslistform').submit();});});</script>Warehouse:&nbsp;<?=form_dropdown('warehouse_id', $warehouse_opt, $warehouse_id, 'id="warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="outgoing_customers_itemscurrsort">
			</div>
			<div id="outgoing_customers_itemssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="outgoing_customers_itemsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/outgoing_customers_itemsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/outgoing_customers_itemsadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				<th><input type='checkbox' class='checkall'></th>
				
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
									echo '<a href="#" class="updown" onclick="outgoing_customers_itemssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="outgoing_customers_itemssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="outgoing_customers_itemssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="outgoing_customers_itemssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('salesorderline__id[]', $row['salesorderline__id'], false);?></td><td><?=$row['salesorderline__date'];?></td><td><?=$row['salesorderline__orderid'];?></td><td><?php if (isset($row['salesorderline__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesorderline__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesorderline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['salesorderline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['salesorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['salesorderline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['salesorderline__quantity'], 2);?></td><td align='right'><?=number_format($row['salesorderline__quantityalreadysent'], 2);?></td><td align='right'><?=number_format($row['salesorderline__quantitytosend'], 2);?></td><td><?php if (isset($row['salesorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['salesorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['salesorderline__lastupdate'];?></td><td><?=$row['salesorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="outgoing_customers_itemsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/outgoing_customers_itemsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="outgoing_customers_itemsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/outgoing_customers_itemsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="outgoing_customers_itemsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="outgoing_customers_itemsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#delivery_order').click(function(){$('#outgoing_customers_itemslistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#outgoing_customers_itemslistform').attr('action','<?=site_url();?>/delivery_orderadd/index/');});});</script><input id='delivery_order' type="submit" value="Delivery Order">
			
		</form>
		</div>