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
					target:        '#delivery_order_for_invoicelist',
					success: 		delivery_order_for_invoiceshowResponse,
		}; 
		
		$('#delivery_order_for_invoicelistform').submit(function() { 
			$('#delivery_order_for_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function delivery_order_for_invoiceconfirmdelete(delid, obj)
	{
		$('#delivery_order_for_invoice-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', delivery_order_for_invoiceconfirmdelete2(delid, obj));
	}
	
	function delivery_order_for_invoiceconfirmdelete2(delid, obj)
	{
		$( "#delivery_order_for_invoice-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					delivery_order_for_invoicecalldeletefn('delivery_order_for_invoicedelete', delid, 'delivery_order_for_invoicelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#delivery_order_for_invoice-dialog-confirm').html('');
	}
	
	function delivery_order_for_invoicesortupdown(field, direction)
	{
		$("#delivery_order_for_invoicecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#delivery_order_for_invoicelist',
					success: 		delivery_order_for_invoiceshowResponse,
		}; 
		$('#delivery_order_for_invoicelistform').ajaxSubmit(options);
		return false;
	}
	
	function delivery_order_for_invoiceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#delivery_order_for_invoicelist',
					success: 		delivery_order_for_invoiceshowResponse,
		}; 
		
		$('#delivery_order_for_invoicelistform').submit(function() { 
			$('#delivery_order_for_invoicelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function delivery_order_for_invoicecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function delivery_order_for_invoiceadd()
	{
		$('#delivery_order_for_invoiceformholder').load('<?=site_url()."/delivery_order_for_invoiceadd/";?>', function()
		{$('#delivery_order_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_order_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#delivery_order_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_order_for_invoicelist' + '\').load(\'<?=site_url();?>/delivery_order_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function delivery_order_for_invoiceedit(id)
	{
		$('#delivery_order_for_invoiceformholder').load('<?=site_url()."/delivery_order_for_invoiceedit/index/";?>' + id, function()
		{$('#delivery_order_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_order_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#delivery_order_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_order_for_invoicelist' + '\').load(\'<?=site_url();?>/delivery_order_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function delivery_order_for_invoiceview(id)
	{
		$('#delivery_order_for_invoiceformholder').load('<?=site_url()."/delivery_order_for_invoiceview/index/";?>' + id, function()
		{$('#delivery_order_for_invoiceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#delivery_order_for_invoiceformholder' + '\').html(\'\');' + '$(\'' + '#delivery_order_for_invoiceclosebutton' + '\').html(\'\');' + '$(\'' + '#delivery_order_for_invoicelist' + '\').load(\'<?=site_url();?>/delivery_order_for_invoicelist\');' + ';"></input>');
		});	
	}
	
	function delivery_order_for_invoicegotopage()
	{
		var page = document.delivery_order_for_invoicelistform.pageno.options[document.delivery_order_for_invoicelistform.pageno.selectedIndex].value;
		
		$("#delivery_order_for_invoicecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#delivery_order_for_invoicelist',
					success: 		delivery_order_for_invoiceshowResponse,
		}; 
		$('#delivery_order_for_invoicelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="delivery_order_for_invoice-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="delivery_order_for_invoiceclosebutton"></div>
		<div id="delivery_order_for_invoiceformholder"></div>
		<div id="delivery_order_for_invoicelist">
		<!--<form method="post" action="<?=site_url();?>/delivery_order_for_invoicelist/index/" id="delivery_order_for_invoicelistform" name="delivery_order_for_invoicelistform">-->
		<form method="post" action="<?=current_url();?>" id="delivery_order_for_invoicelistform" name="delivery_order_for_invoicelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="delivery_order_for_invoicecurrsort">
			</div>
			<div id="delivery_order_for_invoicesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="delivery_order_for_invoiceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/delivery_order_for_invoiceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/delivery_order_for_invoiceadd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (false)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="delivery_order_for_invoicesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="delivery_order_for_invoicesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="delivery_order_for_invoicesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="delivery_order_for_invoicesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['deliveryorder__date'];?></td><td><?=$row['deliveryorder__orderid'];?></td><td><?=$row['deliveryorder__donum'];?></td><td><?=$row['deliveryorder__dodate'];?></td><td><?php if (isset($row['deliveryorder__customer_id']) && $row['deliveryorder__customer_id'] > 0) echo $row['customer__firstname'];?></td><td><?php if (isset($row['deliveryorder__warehouse_id']) && $row['deliveryorder__warehouse_id'] > 0) echo $row['warehouse__name'];?></td><td><?=$row['deliveryorder__deliveredby'];?></td><td><?=$row['deliveryorder__vehicleno'];?></td><td><?=$row['deliveryorder__notes'];?></td><td><?=$row['deliveryorder__lastupdate'];?></td><td><?=$row['deliveryorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="delivery_order_for_invoiceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/delivery_order_for_invoiceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="delivery_order_for_invoiceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/delivery_order_for_invoiceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="delivery_order_for_invoiceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="delivery_order_for_invoicegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>