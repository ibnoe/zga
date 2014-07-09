<script type="text/javascript">
	$(document).ready(function() {
		//$('a').attr('target', '_blank');
		
		
		$('form table.main td a').click( function() {
			openlink($(this).attr('href'));
			return false;
		});
		
	});
	
	$(document).ready(function() {
		var options = { 
					target:        '#purchase_order_quotelist',
					success: 		purchase_order_quoteshowResponse,
		}; 
		
		$('#purchase_order_quotelistform').submit(function() { 
			$('#purchase_order_quotelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function purchase_order_quoteconfirmdelete(delid, obj)
	{
		$('#purchase_order_quote-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', purchase_order_quoteconfirmdelete2(delid, obj));
	}
	
	function purchase_order_quoteconfirmdelete2(delid, obj)
	{
		$( "#purchase_order_quote-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					purchase_order_quotecalldeletefn('purchase_order_quotedelete', delid, 'purchase_order_quotelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#purchase_order_quote-dialog-confirm').html('');
	}
	
	function purchase_order_quotesortupdown(field, direction)
	{
		$("#purchase_order_quotecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#purchase_order_quotelist',
					success: 		purchase_order_quoteshowResponse,
		}; 
		$('#purchase_order_quotelistform').ajaxSubmit(options);
		return false;
	}
	
	function purchase_order_quoteshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#purchase_order_quotelist',
					success: 		purchase_order_quoteshowResponse,
		}; 
		
		$('#purchase_order_quotelistform').submit(function() { 
			$('#purchase_order_quotelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function purchase_order_quotecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function purchase_order_quoteadd()
	{
		$('#purchase_order_quoteformholder').load('<?=site_url()."/purchase_order_quoteadd/";?>', function()
		{$('#purchase_order_quoteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_order_quoteformholder' + '\').html(\'\');' + '$(\'' + '#purchase_order_quoteclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_order_quotelist' + '\').load(\'<?=site_url();?>/purchase_order_quotelist\');' + ';"></input>');
		});	
	}
	
	function purchase_order_quoteedit(id)
	{
		$('#purchase_order_quoteformholder').load('<?=site_url()."/purchase_order_quoteedit/index/";?>' + id, function()
		{$('#purchase_order_quoteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_order_quoteformholder' + '\').html(\'\');' + '$(\'' + '#purchase_order_quoteclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_order_quotelist' + '\').load(\'<?=site_url();?>/purchase_order_quotelist\');' + ';"></input>');
		});	
	}
	
	function purchase_order_quoteview(id)
	{
		$('#purchase_order_quoteformholder').load('<?=site_url()."/purchase_order_quoteview/index/";?>' + id, function()
		{$('#purchase_order_quoteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#purchase_order_quoteformholder' + '\').html(\'\');' + '$(\'' + '#purchase_order_quoteclosebutton' + '\').html(\'\');' + '$(\'' + '#purchase_order_quotelist' + '\').load(\'<?=site_url();?>/purchase_order_quotelist\');' + ';"></input>');
		});	
	}
	
	function purchase_order_quotegotopage()
	{
		var page = document.purchase_order_quotelistform.pageno.options[document.purchase_order_quotelistform.pageno.selectedIndex].value;
		
		$("#purchase_order_quotecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#purchase_order_quotelist',
					success: 		purchase_order_quoteshowResponse,
		}; 
		$('#purchase_order_quotelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="purchase_order_quote-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="purchase_order_quoteclosebutton"></div>
		<div id="purchase_order_quoteformholder"></div>
		<div id="purchase_order_quotelist">
		<!--<form method="post" action="<?=site_url();?>/purchase_order_quotelist/index/" id="purchase_order_quotelistform" name="purchase_order_quotelistform">-->
		<form method="post" action="<?=current_url();?>" id="purchase_order_quotelistform" name="purchase_order_quotelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value=""></input>
					<input name="search" type="submit" value="Quick Search" ></input>
				</div>
			<?php endif; ?>
			<div id="purchase_order_quotecurrsort">
			</div>
			<div id="purchase_order_quotesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="purchase_order_quoteadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_order_quoteadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/purchase_order_quoteadd/index/";?>')">
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
							if (true)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="purchase_order_quotesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="purchase_order_quotesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="purchase_order_quotesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="purchase_order_quotesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					<td><?=anchor('purchase_order_quoteview/index/'.$row['id'], $row['purchaseorderquote__orderid']);?></td><td><?=$row['purchaseorderquote__date'];?></td><td><?=$row['purchaseorderquote__notes'];?></td><td><?=anchor('sppview/index/'.$row['purchaseorderquote__suratpermintaanpembelian_id'], $row['suratpermintaanpembelian__orderid']);?></td><td><?=anchor('supplierview/index/'.$row['purchaseorderquote__supplier_id'], $row['supplier__firstname']);?></td><td><?=anchor('currencyview/index/'.$row['purchaseorderquote__currency_id'], $row['currency__name']);?></td><td><?=number_format($row['purchaseorderquote__currencyrate'], 2);?></td><td><?=anchor('warehouseview/index/'.$row['purchaseorderquote__warehouse_id'], $row['warehouse__name']);?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="purchase_order_quoteview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/purchase_order_quoteview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="purchase_order_quoteedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/purchase_order_quoteedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="purchase_order_quoteconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="purchase_order_quotegotopage();"');?>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>