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
					target:        '#sales_order_open_sentlist',
					success: 		sales_order_open_sentshowResponse,
		}; 
		
		$('#sales_order_open_sentlistform').submit(function() { 
			$('#sales_order_open_sentlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_order_open_sentconfirmdelete(delid, obj)
	{
		$('#sales_order_open_sent-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_order_open_sentconfirmdelete2(delid, obj));
	}
	
	function sales_order_open_sentconfirmdelete2(delid, obj)
	{
		$( "#sales_order_open_sent-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_order_open_sentcalldeletefn('sales_order_open_sentdelete', delid, 'sales_order_open_sentlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order_open_sent-dialog-confirm').html('');
	}
	
	function sales_order_open_sentsortupdown(field, direction)
	{
		$("#sales_order_open_sentcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_order_open_sentlist',
					success: 		sales_order_open_sentshowResponse,
		}; 
		$('#sales_order_open_sentlistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_order_open_sentshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_order_open_sentlist',
					success: 		sales_order_open_sentshowResponse,
		}; 
		
		$('#sales_order_open_sentlistform').submit(function() { 
			$('#sales_order_open_sentlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_order_open_sentcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_order_open_sentadd()
	{
		$('#sales_order_open_sentformholder').load('<?=site_url()."/sales_order_open_sentadd/";?>', function()
		{$('#sales_order_open_sentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_open_sentformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_open_sentclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_open_sentlist' + '\').load(\'<?=site_url();?>/sales_order_open_sentlist\');' + ';"></input>');
		});	
	}
	
	function sales_order_open_sentedit(id)
	{
		$('#sales_order_open_sentformholder').load('<?=site_url()."/sales_order_open_sentedit/index/";?>' + id, function()
		{$('#sales_order_open_sentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_open_sentformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_open_sentclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_open_sentlist' + '\').load(\'<?=site_url();?>/sales_order_open_sentlist\');' + ';"></input>');
		});	
	}
	
	function sales_order_open_sentview(id)
	{
		$('#sales_order_open_sentformholder').load('<?=site_url()."/sales_order_open_sentview/index/";?>' + id, function()
		{$('#sales_order_open_sentclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_order_open_sentformholder' + '\').html(\'\');' + '$(\'' + '#sales_order_open_sentclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_order_open_sentlist' + '\').load(\'<?=site_url();?>/sales_order_open_sentlist\');' + ';"></input>');
		});	
	}
	
	function sales_order_open_sentgotopage()
	{
		var page = document.sales_order_open_sentlistform.pageno.options[document.sales_order_open_sentlistform.pageno.selectedIndex].value;
		
		$("#sales_order_open_sentcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_order_open_sentlist',
					success: 		sales_order_open_sentshowResponse,
		}; 
		$('#sales_order_open_sentlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_order_open_sent-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_order_open_sentclosebutton"></div>
		<div id="sales_order_open_sentformholder"></div>
		<div id="sales_order_open_sentlist">
		<!--<form method="post" action="<?=site_url();?>/sales_order_open_sentlist/index/" id="sales_order_open_sentlistform" name="sales_order_open_sentlistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_order_open_sentlistform" name="sales_order_open_sentlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_order_open_sentcurrsort">
			</div>
			<div id="sales_order_open_sentsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sales_order_open_sentadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_order_open_sentadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_order_open_sentadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_order_open_sentsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_order_open_sentsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_order_open_sentsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_order_open_sentsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_order_open_sentview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['salesorder__orderid'];?></td><td><?=$row['salesorder__date'];?></td><td><?=$row['salesorder__nopenawaran'];?></td><td><?=$row['salesorder__customerponumber'];?></td><td><?php if (isset($row['salesorder__marketingofficer_id']) && $row['marketingofficer__name'] != "") echo anchor('marketing_officerview/index/'.$row['salesorder__marketingofficer_id'], $row['marketingofficer__name']);?></td><td><?=$row['salesorder__notes'];?></td><td><?php if (isset($row['salesorder__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesorder__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesorder__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['salesorder__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['salesorder__currencyrate'], 2);?></td><td align='right'><?=number_format($row['salesorder__total'], 2);?></td><td align='right'><?=number_format($row['salesorder__totaldiscount'], 2);?></td><td align='right'><?=number_format($row['salesorder__totaltax'], 2);?></td><td><?=$row['salesorder__lastupdate'];?></td><td><?=$row['salesorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_order_open_sentview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_order_open_sentview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_order_open_sentedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_order_open_sentedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_order_open_sentconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_order_open_sentgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>