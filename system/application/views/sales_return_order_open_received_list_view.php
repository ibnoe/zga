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
					target:        '#sales_return_order_open_receivedlist',
					success: 		sales_return_order_open_receivedshowResponse,
		}; 
		
		$('#sales_return_order_open_receivedlistform').submit(function() { 
			$('#sales_return_order_open_receivedlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function sales_return_order_open_receivedconfirmdelete(delid, obj)
	{
		$('#sales_return_order_open_received-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', sales_return_order_open_receivedconfirmdelete2(delid, obj));
	}
	
	function sales_return_order_open_receivedconfirmdelete2(delid, obj)
	{
		$( "#sales_return_order_open_received-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					sales_return_order_open_receivedcalldeletefn('sales_return_order_open_receiveddelete', delid, 'sales_return_order_open_receivedlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#sales_return_order_open_received-dialog-confirm').html('');
	}
	
	function sales_return_order_open_receivedsortupdown(field, direction)
	{
		$("#sales_return_order_open_receivedcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#sales_return_order_open_receivedlist',
					success: 		sales_return_order_open_receivedshowResponse,
		}; 
		$('#sales_return_order_open_receivedlistform').ajaxSubmit(options);
		return false;
	}
	
	function sales_return_order_open_receivedshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#sales_return_order_open_receivedlist',
					success: 		sales_return_order_open_receivedshowResponse,
		}; 
		
		$('#sales_return_order_open_receivedlistform').submit(function() { 
			$('#sales_return_order_open_receivedlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function sales_return_order_open_receivedcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function sales_return_order_open_receivedadd()
	{
		$('#sales_return_order_open_receivedformholder').load('<?=site_url()."/sales_return_order_open_receivedadd/";?>', function()
		{$('#sales_return_order_open_receivedclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_order_open_receivedformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_order_open_receivedclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_order_open_receivedlist' + '\').load(\'<?=site_url();?>/sales_return_order_open_receivedlist\');' + ';"></input>');
		});	
	}
	
	function sales_return_order_open_receivededit(id)
	{
		$('#sales_return_order_open_receivedformholder').load('<?=site_url()."/sales_return_order_open_receivededit/index/";?>' + id, function()
		{$('#sales_return_order_open_receivedclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_order_open_receivedformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_order_open_receivedclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_order_open_receivedlist' + '\').load(\'<?=site_url();?>/sales_return_order_open_receivedlist\');' + ';"></input>');
		});	
	}
	
	function sales_return_order_open_receivedview(id)
	{
		$('#sales_return_order_open_receivedformholder').load('<?=site_url()."/sales_return_order_open_receivedview/index/";?>' + id, function()
		{$('#sales_return_order_open_receivedclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#sales_return_order_open_receivedformholder' + '\').html(\'\');' + '$(\'' + '#sales_return_order_open_receivedclosebutton' + '\').html(\'\');' + '$(\'' + '#sales_return_order_open_receivedlist' + '\').load(\'<?=site_url();?>/sales_return_order_open_receivedlist\');' + ';"></input>');
		});	
	}
	
	function sales_return_order_open_receivedgotopage()
	{
		var page = document.sales_return_order_open_receivedlistform.pageno.options[document.sales_return_order_open_receivedlistform.pageno.selectedIndex].value;
		
		$("#sales_return_order_open_receivedcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#sales_return_order_open_receivedlist',
					success: 		sales_return_order_open_receivedshowResponse,
		}; 
		$('#sales_return_order_open_receivedlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="sales_return_order_open_received-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="sales_return_order_open_receivedclosebutton"></div>
		<div id="sales_return_order_open_receivedformholder"></div>
		<div id="sales_return_order_open_receivedlist">
		<!--<form method="post" action="<?=site_url();?>/sales_return_order_open_receivedlist/index/" id="sales_return_order_open_receivedlistform" name="sales_return_order_open_receivedlistform">-->
		<form method="post" action="<?=current_url();?>" id="sales_return_order_open_receivedlistform" name="sales_return_order_open_receivedlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="sales_return_order_open_receivedcurrsort">
			</div>
			<div id="sales_return_order_open_receivedsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="sales_return_order_open_receivedadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_order_open_receivedadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/sales_return_order_open_receivedadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="sales_return_order_open_receivedsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="sales_return_order_open_receivedsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="sales_return_order_open_receivedsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="sales_return_order_open_receivedsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/sales_return_order_open_receivedview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['salesreturnorder__date'];?></td><td><?=$row['salesreturnorder__salesreturnorderid'];?></td><td><?php if (isset($row['salesreturnorder__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['salesreturnorder__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['salesreturnorder__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['salesreturnorder__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['salesreturnorder__currencyrate'], 2);?></td><td><?=$row['salesreturnorder__notes'];?></td><td><?=$row['salesreturnorder__lastupdate'];?></td><td><?=$row['salesreturnorder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="sales_return_order_open_receivedview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/sales_return_order_open_receivedview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="sales_return_order_open_receivededit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/sales_return_order_open_receivededit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="sales_return_order_open_receivedconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="sales_return_order_open_receivedgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>