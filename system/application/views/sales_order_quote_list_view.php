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
					target:        '#sales_order_quotelist',
					success: 		sales_order_quoteshowResponse,
		}; 
		
		$('#sales_order_quotelistform').submit(function() { 
			$('#sales_order_quotelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_order_quoteconfirmdelete(delid, obj)
	{
		$('#sales_order_quote-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_order_quoteconfirmdelete2(delid, obj));
	}
	
	function sales_order_quoteconfirmdelete2(delid, obj)
	{
		$( "#sales_order_quote-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_order_quotecalldeletefn('sales_order_quotedelete', delid, 'sales_order_quotelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_quote-dialog-confirm').html('');
	}
	
	function sales_order_quotesortupdown(field, direction)
	{
		$("#sales_order_quotecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_order_quotelist',
					success: 		sales_order_quoteshowResponse,
		}; 
		$('#sales_order_quotelistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_order_quoteshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_order_quotelist',
					success: 		sales_order_quoteshowResponse,
		}; 
		
		$('#sales_order_quotelistform').submit(function() { 
			$('#sales_order_quotelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_order_quotecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_order_quoteadd()
	{
		$('#sales_order_quoteformholder').load('<?=site_url()."/sales_order_quoteadd/";?>', function()
		{$('#sales_order_quoteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_quoteformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_quoteclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_quotelist' + '\').load(\'<?=site_url();?>/sales_order_quotelist\');' + ';"></input>');
		});	
	}
	
	function sales_order_quoteedit(id)
	{
		$('#sales_order_quoteformholder').load('<?=site_url()."/sales_order_quoteedit/index/";?>' + id, function()
		{$('#sales_order_quoteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_quoteformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_quoteclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_quotelist' + '\').load(\'<?=site_url();?>/sales_order_quotelist\');' + ';"></input>');
		});	
	}
	
	function sales_order_quoteview(id)
	{
		$('#sales_order_quoteformholder').load('<?=site_url()."/sales_order_quoteview/index/";?>' + id, function()
		{$('#sales_order_quoteclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_quoteformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_quoteclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_quotelist' + '\').load(\'<?=site_url();?>/sales_order_quotelist\');' + ';"></input>');
		});	
	}
	
	function sales_order_quotegotopage()
	{
		var page = document.sales_order_quotelistform.pageno.options[document.sales_order_quotelistform.pageno.selectedIndex].value;
		
		$("#sales_order_quotecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_order_quotelist',
					success: 		sales_order_quoteshowResponse,
		}; 
		$('#sales_order_quotelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_order_quote-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_order_quoteclosebutton"></div>
		<div id="sales_order_quoteformholder"></div>
		<div id="sales_order_quotelist">
		<!--<form method="post" action="<?=site_url();?>/sales_order_quotelist/index/" id="sales_order_quotelistform" name="sales_order_quotelistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_order_quotelistform" name="sales_order_quotelistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#statusfilter').change(function() { $('#sales_order_quotelistform').submit();});});</script>Status:&nbsp;<?=form_dropdown('status', $status_opt, $status, 'id="statusfilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_order_quotecurrsort">
			</div>
			<div id="sales_order_quotesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sales_order_quoteadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_order_quoteadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_order_quoteadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_order_quotesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_order_quotesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_order_quotesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_order_quotesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_order_quoteview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('sales_order_quoteview/index/'.$row['id'], $row['salesorder__nopenawaran']);?></td><td><?=$row['salesorder__customerponumber'];?></td><td><?=$row['salesorder__date'];?></td><td><?=$row['salesorder__notes'];?></td><td><?php if (isset($row['salesorder__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesorder__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesorder__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['salesorder__currency_id'], $row['currency__name']);?></td><td><?=number_format($row['salesorder__currencyrate'], 2);?></td><td><?php if (isset($row['salesorder__marketingofficer_id']) && $row['marketingofficer__name'] != "") echo anchor('marketing_officerview/index/'.$row['salesorder__marketingofficer_id'], $row['marketingofficer__name']);?></td><td><?=$row['salesorder__status'];?></td><td><?=$row['salesorder__orderid'];?></td><td><?=number_format($row['salesorder__total'], 2);?></td><td><?=number_format($row['salesorder__totaldiscount'], 2);?></td><td><?=number_format($row['salesorder__totaltax'], 2);?></td><td><?=number_format($row['salesorder__grandtotal'], 2);?></td><td><?=$row['salesorder__lastupdate'];?></td><td><?=$row['salesorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_order_quoteview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_order_quoteview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_order_quoteedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_order_quoteedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_order_quoteconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_order_quotegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>