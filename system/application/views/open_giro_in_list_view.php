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
					target:        '#open_giro_inlist',
					success: 		open_giro_inshowResponse,
		}; 
		
		$('#open_giro_inlistform').submit(function() { 
			$('#open_giro_inlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_giro_inconfirmdelete(delid, obj)
	{
		$('#open_giro_in-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_giro_inconfirmdelete2(delid, obj));
	}
	
	function open_giro_inconfirmdelete2(delid, obj)
	{
		$( "#open_giro_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_giro_incalldeletefn('open_giro_indelete', delid, 'open_giro_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_giro_in-dialog-confirm').html('');
	}
	
	function open_giro_insortupdown(field, direction)
	{
		$("#open_giro_incurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_giro_inlist',
					success: 		open_giro_inshowResponse,
		}; 
		$('#open_giro_inlistform').ajaxSubmit(options);
		return false;
	}
	
	function open_giro_inshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_giro_inlist',
					success: 		open_giro_inshowResponse,
		}; 
		
		$('#open_giro_inlistform').submit(function() { 
			$('#open_giro_inlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_giro_incalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_giro_inadd()
	{
		$('#open_giro_informholder').load('<?=site_url()."/open_giro_inadd/";?>', function()
		{$('#open_giro_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_giro_informholder' + '\').html(\'\');' + '$(\'' + '#open_giro_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_giro_inlist' + '\').load(\'<?=site_url();?>/open_giro_inlist\');' + ';"></input>');
		});	
	}
	
	function open_giro_inedit(id)
	{
		$('#open_giro_informholder').load('<?=site_url()."/open_giro_inedit/index/";?>' + id, function()
		{$('#open_giro_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_giro_informholder' + '\').html(\'\');' + '$(\'' + '#open_giro_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_giro_inlist' + '\').load(\'<?=site_url();?>/open_giro_inlist\');' + ';"></input>');
		});	
	}
	
	function open_giro_inview(id)
	{
		$('#open_giro_informholder').load('<?=site_url()."/open_giro_inview/index/";?>' + id, function()
		{$('#open_giro_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_giro_informholder' + '\').html(\'\');' + '$(\'' + '#open_giro_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_giro_inlist' + '\').load(\'<?=site_url();?>/open_giro_inlist\');' + ';"></input>');
		});	
	}
	
	function open_giro_ingotopage()
	{
		var page = document.open_giro_inlistform.pageno.options[document.open_giro_inlistform.pageno.selectedIndex].value;
		
		$("#open_giro_incurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_giro_inlist',
					success: 		open_giro_inshowResponse,
		}; 
		$('#open_giro_inlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="open_giro_in-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_giro_inclosebutton"></div>
		<div id="open_giro_informholder"></div>
		<div id="open_giro_inlist">
		<!--<form method="post" action="<?=site_url();?>/open_giro_inlist/index/" id="open_giro_inlistform" name="open_giro_inlistform">-->
		<form method="post" action="<?=current_url();?>" id="open_giro_inlistform" name="open_giro_inlistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#customerfilter').change(function() { $('#open_giro_inlistform').submit();});});</script>Customer:&nbsp;<?=form_dropdown('customer_id', $customer_opt, $customer_id, 'id="customerfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#currencyfilter').change(function() { $('#open_giro_inlistform').submit();});});</script>Currency:&nbsp;<?=form_dropdown('currency_id', $currency_opt, $currency_id, 'id="currencyfilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_giro_incurrsort">
			</div>
			<div id="open_giro_insort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="open_giro_inadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_giro_inadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_giro_inadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="open_giro_insortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_giro_insortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_giro_insortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_giro_insortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('giroin__id[]', $row['giroin__id'], false);?></td><td><?=$row['giroin__createdate'];?></td><td><?=$row['giroin__giroinid'];?></td><td><?php if (isset($row['giroin__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['giroin__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['giroin__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['giroin__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['giroin__amount'], 2);?></td><td align='right'><?=number_format($row['giroin__amountused'], 2);?></td><td><?php if ($row['giroin__usedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['giroin__lastupdate'];?></td><td><?=$row['giroin__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_giro_inview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_giro_inview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_giro_inedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_giro_inedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_giro_inconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_giro_ingotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#giro_clearance').click(function(){$('#open_giro_inlistform').unbind('submit').find('input:submit,input:image,button:submit').unbind('click');$('#open_giro_inlistform').attr('action','<?=site_url();?>/giro_in_clearanceadd/index/');});});</script><input id='giro_clearance' type="submit" value="Giro Clearance">
			
		</form>
		</div>