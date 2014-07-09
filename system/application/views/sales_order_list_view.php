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
					target:        '#sales_orderlist',
					success: 		sales_ordershowResponse,
		}; 
		
		$('#sales_orderlistform').submit(function() { 
			$('#sales_orderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_orderconfirmdelete(delid, obj)
	{
		$('#sales_order-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_orderconfirmdelete2(delid, obj));
	}
	
	function sales_orderconfirmdelete2(delid, obj)
	{
		$( "#sales_order-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_ordercalldeletefn('sales_orderdelete', delid, 'sales_orderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_order-dialog-confirm').html('');
	}
	
	function sales_ordersortupdown(field, direction)
	{
		$("#sales_ordercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_orderlist',
					success: 		sales_ordershowResponse,
		}; 
		$('#sales_orderlistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_ordershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_orderlist',
					success: 		sales_ordershowResponse,
		}; 
		
		$('#sales_orderlistform').submit(function() { 
			$('#sales_orderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_ordercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_orderadd()
	{
		$('#sales_orderformholder').load('<?=site_url()."/sales_orderadd/";?>', function()
		{$('#sales_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_orderformholder' + '\').html(\'\');' + '$(\'' + '#sales_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_orderlist' + '\').load(\'<?=site_url();?>/sales_orderlist\');' + ';"></input>');
		});	
	}
	
	function sales_orderedit(id)
	{
		$('#sales_orderformholder').load('<?=site_url()."/sales_orderedit/index/";?>' + id, function()
		{$('#sales_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_orderformholder' + '\').html(\'\');' + '$(\'' + '#sales_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_orderlist' + '\').load(\'<?=site_url();?>/sales_orderlist\');' + ';"></input>');
		});	
	}
	
	function sales_orderview(id)
	{
		$('#sales_orderformholder').load('<?=site_url()."/sales_orderview/index/";?>' + id, function()
		{$('#sales_orderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_orderformholder' + '\').html(\'\');' + '$(\'' + '#sales_orderclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_orderlist' + '\').load(\'<?=site_url();?>/sales_orderlist\');' + ';"></input>');
		});	
	}
	
	function sales_ordergotopage()
	{
		var page = document.sales_orderlistform.pageno.options[document.sales_orderlistform.pageno.selectedIndex].value;
		
		$("#sales_ordercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_orderlist',
					success: 		sales_ordershowResponse,
		}; 
		$('#sales_orderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_order-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_orderclosebutton"></div>
		<div id="sales_orderformholder"></div>
		<div id="sales_orderlist">
		<!--<form method="post" action="<?=site_url();?>/sales_orderlist/index/" id="sales_orderlistform" name="sales_orderlistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_orderlistform" name="sales_orderlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_ordercurrsort">
			</div>
			<div id="sales_ordersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sales_orderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_orderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_orderadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_ordersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_ordersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_ordersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_ordersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_orderview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('sales_orderview/index/'.$row['id'], $row['salesorder__orderid']);?></td><td><?=$row['salesorder__date'];?></td><td><?=$row['salesorder__nopenawaran'];?></td><td><?=$row['salesorder__customerponumber'];?></td><td><?php if (isset($row['salesorder__marketingofficer_id']) && $row['marketingofficer__name'] != "") echo anchor('marketing_officerview/index/'.$row['salesorder__marketingofficer_id'], $row['marketingofficer__name']);?></td><td><?=$row['salesorder__notes'];?></td><td><?php if (isset($row['salesorder__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesorder__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesorder__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['salesorder__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['salesorder__currencyrate'], 2);?></td><td align='right'><?=number_format($row['salesorder__total'], 2);?></td><td align='right'><?=number_format($row['salesorder__totaldiscount'], 2);?></td><td align='right'><?=number_format($row['salesorder__totaltax'], 2);?></td><td><?=$row['salesorder__lastupdate'];?></td><td><?=$row['salesorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_orderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_orderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_orderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_orderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_orderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_ordergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>