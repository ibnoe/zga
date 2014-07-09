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
					target:        '#sent_customers_itemslist',
					success: 		sent_customers_itemsshowResponse,
		}; 
		
		$('#sent_customers_itemslistform').submit(function() { 
			$('#sent_customers_itemslistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sent_customers_itemsconfirmdelete(delid, obj)
	{
		$('#sent_customers_items-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sent_customers_itemsconfirmdelete2(delid, obj));
	}
	
	function sent_customers_itemsconfirmdelete2(delid, obj)
	{
		$( "#sent_customers_items-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sent_customers_itemscalldeletefn('sent_customers_itemsdelete', delid, 'sent_customers_itemslist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sent_customers_items-dialog-confirm').html('');
	}
	
	function sent_customers_itemssortupdown(field, direction)
	{
		$("#sent_customers_itemscurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sent_customers_itemslist',
					success: 		sent_customers_itemsshowResponse,
		}; 
		$('#sent_customers_itemslistform').ajaxSubmit(options);
		return false;
	}
	
	function sent_customers_itemsshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sent_customers_itemslist',
					success: 		sent_customers_itemsshowResponse,
		}; 
		
		$('#sent_customers_itemslistform').submit(function() { 
			$('#sent_customers_itemslistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sent_customers_itemscalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sent_customers_itemsadd()
	{
		$('#sent_customers_itemsformholder').load('<?=site_url()."/sent_customers_itemsadd/";?>', function()
		{$('#sent_customers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sent_customers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#sent_customers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#sent_customers_itemslist' + '\').load(\'<?=site_url();?>/sent_customers_itemslist\');' + ';"></input>');
		});	
	}
	
	function sent_customers_itemsedit(id)
	{
		$('#sent_customers_itemsformholder').load('<?=site_url()."/sent_customers_itemsedit/index/";?>' + id, function()
		{$('#sent_customers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sent_customers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#sent_customers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#sent_customers_itemslist' + '\').load(\'<?=site_url();?>/sent_customers_itemslist\');' + ';"></input>');
		});	
	}
	
	function sent_customers_itemsview(id)
	{
		$('#sent_customers_itemsformholder').load('<?=site_url()."/sent_customers_itemsview/index/";?>' + id, function()
		{$('#sent_customers_itemsclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sent_customers_itemsformholder' + '\').html(\'\');' + '$(\'' + '#sent_customers_itemsclosebutton' + '\').html(\'\');' + '$(\'' + '#sent_customers_itemslist' + '\').load(\'<?=site_url();?>/sent_customers_itemslist\');' + ';"></input>');
		});	
	}
	
	function sent_customers_itemsgotopage()
	{
		var page = document.sent_customers_itemslistform.pageno.options[document.sent_customers_itemslistform.pageno.selectedIndex].value;
		
		$("#sent_customers_itemscurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sent_customers_itemslist',
					success: 		sent_customers_itemsshowResponse,
		}; 
		$('#sent_customers_itemslistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sent_customers_items-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sent_customers_itemsclosebutton"></div>
		<div id="sent_customers_itemsformholder"></div>
		<div id="sent_customers_itemslist">
		<!--<form method="post" action="<?=site_url();?>/sent_customers_itemslist/index/" id="sent_customers_itemslistform" name="sent_customers_itemslistform">-->
		<form method="post" action="<?=current_url();?>" id="sent_customers_itemslistform" name="sent_customers_itemslistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#customerfilter').change(function() { $('#sent_customers_itemslistform').submit();});});</script>Customer:&nbsp;<?=form_dropdown('customer_id', $customer_opt, $customer_id, 'id="customerfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#warehousefilter').change(function() { $('#sent_customers_itemslistform').submit();});});</script>Warehouse:&nbsp;<?=form_dropdown('warehouse_id', $warehouse_opt, $warehouse_id, 'id="warehousefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sent_customers_itemscurrsort">
			</div>
			<div id="sent_customers_itemssort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="sent_customers_itemsadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sent_customers_itemsadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sent_customers_itemsadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sent_customers_itemssortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sent_customers_itemssortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sent_customers_itemssortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sent_customers_itemssortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('deliveryorderline__id[]', $row['deliveryorderline__id'], false);?></td><td><?=$row['deliveryorderline__date'];?></td><td><?=$row['deliveryorderline__orderid'];?></td><td><?php if (isset($row['deliveryorderline__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['deliveryorderline__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['deliveryorderline__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['deliveryorderline__warehouse_id'], $row['warehouse__name']);?></td><td><?php if (isset($row['deliveryorderline__item_id']) && $row['item__name'] != "") echo anchor('itemview/index/'.$row['deliveryorderline__item_id'], $row['item__name']);?></td><td align='right'><?=number_format($row['deliveryorderline__quantitytosend'], 2);?></td><td><?php if (isset($row['deliveryorderline__uom_id']) && $row['uom__name'] != "") echo anchor('uomview/index/'.$row['deliveryorderline__uom_id'], $row['uom__name']);?></td><td><?=$row['deliveryorderline__lastupdate'];?></td><td><?=$row['deliveryorderline__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sent_customers_itemsview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sent_customers_itemsview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sent_customers_itemsedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sent_customers_itemsedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sent_customers_itemsconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sent_customers_itemsgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#sales_return_order').click(function(){$('#sent_customers_itemslistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#sent_customers_itemslistform').attr('action','<?=site_url();?>/sales_return_orderadd/index/');});});</script><input id='sales_return_order' type="submit" value="Sales Return Order">
			
		</form>
		</div>