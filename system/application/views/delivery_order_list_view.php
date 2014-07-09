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
					target:        '#delivery_orderlist',
					success: 		delivery_ordershowResponse,
		}; 
		
		$('#delivery_orderlistform').submit(function() { 
			$('#delivery_orderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function delivery_orderconfirmdelete(delid, obj)
	{
		$('#delivery_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', delivery_orderconfirmdelete2(delid, obj));
	}
	
	function delivery_orderconfirmdelete2(delid, obj)
	{
		$( "#delivery_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					delivery_ordercalldeletefn('delivery_orderdelete', delid, 'delivery_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#delivery_order-dialog-confirm').html('');
	}
	
	function delivery_ordersortupdown(field, direction)
	{
		$("#delivery_ordercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#delivery_orderlist',
					success: 		delivery_ordershowResponse,
		}; 
		$('#delivery_orderlistform').ajaxSubmit(options);
		return false;
	}
	
	function delivery_ordershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#delivery_orderlist',
					success: 		delivery_ordershowResponse,
		}; 
		
		$('#delivery_orderlistform').submit(function() { 
			$('#delivery_orderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function delivery_ordercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function delivery_orderadd()
	{
		$('#delivery_orderformholder').load('<?=site_url()."/delivery_orderadd/";?>', function()
		{$('#delivery_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_orderformholder' + '\').html(\'\');' + '$(\'' + '#delivery_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_orderlist' + '\').load(\'<?=site_url();?>/delivery_orderlist\');' + ';"></input>');
		});	
	}
	
	function delivery_orderedit(id)
	{
		$('#delivery_orderformholder').load('<?=site_url()."/delivery_orderedit/index/";?>' + id, function()
		{$('#delivery_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_orderformholder' + '\').html(\'\');' + '$(\'' + '#delivery_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_orderlist' + '\').load(\'<?=site_url();?>/delivery_orderlist\');' + ';"></input>');
		});	
	}
	
	function delivery_orderview(id)
	{
		$('#delivery_orderformholder').load('<?=site_url()."/delivery_orderview/index/";?>' + id, function()
		{$('#delivery_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_orderformholder' + '\').html(\'\');' + '$(\'' + '#delivery_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_orderlist' + '\').load(\'<?=site_url();?>/delivery_orderlist\');' + ';"></input>');
		});	
	}
	
	function delivery_ordergotopage()
	{
		var page = document.delivery_orderlistform.pageno.options[document.delivery_orderlistform.pageno.selectedIndex].value;
		
		$("#delivery_ordercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#delivery_orderlist',
					success: 		delivery_ordershowResponse,
		}; 
		$('#delivery_orderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="delivery_order-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="delivery_orderclosebutton"></div>
		<div id="delivery_orderformholder"></div>
		<div id="delivery_orderlist">
		<!--<form method="post" action="<?=site_url();?>/delivery_orderlist/index/" id="delivery_orderlistform" name="delivery_orderlistform">-->
		<form method="post" action="<?=current_url();?>" id="delivery_orderlistform" name="delivery_orderlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="delivery_ordercurrsort">
			</div>
			<div id="delivery_ordersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="delivery_orderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/delivery_orderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/delivery_orderadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="delivery_ordersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="delivery_ordersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="delivery_ordersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="delivery_ordersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/delivery_orderview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('delivery_orderview/index/'.$row['id'], $row['deliveryorder__date']);?></td><td><?=$row['deliveryorder__orderid'];?></td><td><?=$row['deliveryorder__donum'];?></td><td><?=$row['deliveryorder__dodate'];?></td><td><?php if (isset($row['deliveryorder__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['deliveryorder__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['deliveryorder__warehouse_id']) && $row['warehouse__name'] != "") echo anchor('warehouseview/index/'.$row['deliveryorder__warehouse_id'], $row['warehouse__name']);?></td><td><?=$row['deliveryorder__deliveredby'];?></td><td><?=$row['deliveryorder__vehicleno'];?></td><td><?=$row['deliveryorder__notes'];?></td><td><?=$row['deliveryorder__lastupdate'];?></td><td><?=$row['deliveryorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="delivery_orderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/delivery_orderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="delivery_orderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/delivery_orderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="delivery_orderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="delivery_ordergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>