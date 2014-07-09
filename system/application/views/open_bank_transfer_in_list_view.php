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
					target:        '#open_bank_transfer_inlist',
					success: 		open_bank_transfer_inshowResponse,
		}; 
		
		$('#open_bank_transfer_inlistform').submit(function() { 
			$('#open_bank_transfer_inlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_bank_transfer_inconfirmdelete(delid, obj)
	{
		$('#open_bank_transfer_in-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_bank_transfer_inconfirmdelete2(delid, obj));
	}
	
	function open_bank_transfer_inconfirmdelete2(delid, obj)
	{
		$( "#open_bank_transfer_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_bank_transfer_incalldeletefn('open_bank_transfer_indelete', delid, 'open_bank_transfer_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_bank_transfer_in-dialog-confirm').html('');
	}
	
	function open_bank_transfer_insortupdown(field, direction)
	{
		$("#open_bank_transfer_incurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_bank_transfer_inlist',
					success: 		open_bank_transfer_inshowResponse,
		}; 
		$('#open_bank_transfer_inlistform').ajaxSubmit(options);
		return false;
	}
	
	function open_bank_transfer_inshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_bank_transfer_inlist',
					success: 		open_bank_transfer_inshowResponse,
		}; 
		
		$('#open_bank_transfer_inlistform').submit(function() { 
			$('#open_bank_transfer_inlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_bank_transfer_incalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_bank_transfer_inadd()
	{
		$('#open_bank_transfer_informholder').load('<?=site_url()."/open_bank_transfer_inadd/";?>', function()
		{$('#open_bank_transfer_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_bank_transfer_informholder' + '\').html(\'\');' + '$(\'' + '#open_bank_transfer_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_bank_transfer_inlist' + '\').load(\'<?=site_url();?>/open_bank_transfer_inlist\');' + ';"></input>');
		});	
	}
	
	function open_bank_transfer_inedit(id)
	{
		$('#open_bank_transfer_informholder').load('<?=site_url()."/open_bank_transfer_inedit/index/";?>' + id, function()
		{$('#open_bank_transfer_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_bank_transfer_informholder' + '\').html(\'\');' + '$(\'' + '#open_bank_transfer_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_bank_transfer_inlist' + '\').load(\'<?=site_url();?>/open_bank_transfer_inlist\');' + ';"></input>');
		});	
	}
	
	function open_bank_transfer_inview(id)
	{
		$('#open_bank_transfer_informholder').load('<?=site_url()."/open_bank_transfer_inview/index/";?>' + id, function()
		{$('#open_bank_transfer_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_bank_transfer_informholder' + '\').html(\'\');' + '$(\'' + '#open_bank_transfer_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_bank_transfer_inlist' + '\').load(\'<?=site_url();?>/open_bank_transfer_inlist\');' + ';"></input>');
		});	
	}
	
	function open_bank_transfer_ingotopage()
	{
		var page = document.open_bank_transfer_inlistform.pageno.options[document.open_bank_transfer_inlistform.pageno.selectedIndex].value;
		
		$("#open_bank_transfer_incurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_bank_transfer_inlist',
					success: 		open_bank_transfer_inshowResponse,
		}; 
		$('#open_bank_transfer_inlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="open_bank_transfer_in-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_bank_transfer_inclosebutton"></div>
		<div id="open_bank_transfer_informholder"></div>
		<div id="open_bank_transfer_inlist">
		<!--<form method="post" action="<?=site_url();?>/open_bank_transfer_inlist/index/" id="open_bank_transfer_inlistform" name="open_bank_transfer_inlistform">-->
		<form method="post" action="<?=current_url();?>" id="open_bank_transfer_inlistform" name="open_bank_transfer_inlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_bank_transfer_incurrsort">
			</div>
			<div id="open_bank_transfer_insort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="open_bank_transfer_inadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_bank_transfer_inadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_bank_transfer_inadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="open_bank_transfer_insortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_bank_transfer_insortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_bank_transfer_insortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_bank_transfer_insortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('banktransfermasuk__id[]', $row['banktransfermasuk__id'], false);?></td><td><?=$row['banktransfermasuk__idstring'];?></td><td><?=$row['banktransfermasuk__date'];?></td><td><?php if (isset($row['banktransfermasuk__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['banktransfermasuk__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['banktransfermasuk__amount'], 2);?></td><td><?=$row['banktransfermasuk__notes'];?></td><td><?php if ($row['banktransfermasuk__transferedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['banktransfermasuk__lastupdate'];?></td><td><?=$row['banktransfermasuk__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_bank_transfer_inview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_bank_transfer_inview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_bank_transfer_inedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_bank_transfer_inedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_bank_transfer_inconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_bank_transfer_ingotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#mark_as_transferred').click(function(){var data = $('#open_bank_transfer_inlistform').serialize();$.ajax({type: 'POST',url: '<?=site_url();?>/banktransfermasuk_transferedflag',data: data,success: function (resp) {var options = { 	target:        '#open_bank_transfer_inlist',	success: 		open_bank_transfer_inshowResponse,}; $('#open_bank_transfer_inlistform').ajaxSubmit(options);},});});});</script><input id='mark_as_transferred' type="submit" value="Mark As Transferred">
			
		</form>
		</div>