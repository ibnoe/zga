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
					target:        '#open_credit_note_inlist',
					success: 		open_credit_note_inshowResponse,
		}; 
		
		$('#open_credit_note_inlistform').submit(function() { 
			$('#open_credit_note_inlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_credit_note_inconfirmdelete(delid, obj)
	{
		$('#open_credit_note_in-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_credit_note_inconfirmdelete2(delid, obj));
	}
	
	function open_credit_note_inconfirmdelete2(delid, obj)
	{
		$( "#open_credit_note_in-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_credit_note_incalldeletefn('open_credit_note_indelete', delid, 'open_credit_note_inlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_credit_note_in-dialog-confirm').html('');
	}
	
	function open_credit_note_insortupdown(field, direction)
	{
		$("#open_credit_note_incurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_credit_note_inlist',
					success: 		open_credit_note_inshowResponse,
		}; 
		$('#open_credit_note_inlistform').ajaxSubmit(options);
		return false;
	}
	
	function open_credit_note_inshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_credit_note_inlist',
					success: 		open_credit_note_inshowResponse,
		}; 
		
		$('#open_credit_note_inlistform').submit(function() { 
			$('#open_credit_note_inlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_credit_note_incalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_credit_note_inadd()
	{
		$('#open_credit_note_informholder').load('<?=site_url()."/open_credit_note_inadd/";?>', function()
		{$('#open_credit_note_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_credit_note_informholder' + '\').html(\'\');' + '$(\'' + '#open_credit_note_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_credit_note_inlist' + '\').load(\'<?=site_url();?>/open_credit_note_inlist\');' + ';"></input>');
		});	
	}
	
	function open_credit_note_inedit(id)
	{
		$('#open_credit_note_informholder').load('<?=site_url()."/open_credit_note_inedit/index/";?>' + id, function()
		{$('#open_credit_note_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_credit_note_informholder' + '\').html(\'\');' + '$(\'' + '#open_credit_note_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_credit_note_inlist' + '\').load(\'<?=site_url();?>/open_credit_note_inlist\');' + ';"></input>');
		});	
	}
	
	function open_credit_note_inview(id)
	{
		$('#open_credit_note_informholder').load('<?=site_url()."/open_credit_note_inview/index/";?>' + id, function()
		{$('#open_credit_note_inclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_credit_note_informholder' + '\').html(\'\');' + '$(\'' + '#open_credit_note_inclosebutton' + '\').html(\'\');' + '$(\'' + '#open_credit_note_inlist' + '\').load(\'<?=site_url();?>/open_credit_note_inlist\');' + ';"></input>');
		});	
	}
	
	function open_credit_note_ingotopage()
	{
		var page = document.open_credit_note_inlistform.pageno.options[document.open_credit_note_inlistform.pageno.selectedIndex].value;
		
		$("#open_credit_note_incurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_credit_note_inlist',
					success: 		open_credit_note_inshowResponse,
		}; 
		$('#open_credit_note_inlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="open_credit_note_in-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_credit_note_inclosebutton"></div>
		<div id="open_credit_note_informholder"></div>
		<div id="open_credit_note_inlist">
		<!--<form method="post" action="<?=site_url();?>/open_credit_note_inlist/index/" id="open_credit_note_inlistform" name="open_credit_note_inlistform">-->
		<form method="post" action="<?=current_url();?>" id="open_credit_note_inlistform" name="open_credit_note_inlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_credit_note_incurrsort">
			</div>
			<div id="open_credit_note_insort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="open_credit_note_inadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_credit_note_inadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_credit_note_inadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="open_credit_note_insortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_credit_note_insortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_credit_note_insortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_credit_note_insortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('creditnotein__id[]', $row['creditnotein__id'], false);?></td><td><?=$row['creditnotein__creditnoteinid'];?></td><td><?=$row['creditnotein__date'];?></td><td><?=$row['creditnotein__expirydate'];?></td><td><?php if (isset($row['creditnotein__supplier_id']) && $row['supplier__firstname'] != "") echo anchor('supplierview/index/'.$row['creditnotein__supplier_id'], $row['supplier__firstname']);?></td><td><?php if (isset($row['creditnotein__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['creditnotein__coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['creditnotein__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['creditnotein__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['creditnotein__amount'], 2);?></td><td align='right'><?=number_format($row['creditnotein__amountused'], 2);?></td><td><?=$row['creditnotein__notes'];?></td><td><?php if ($row['creditnotein__usedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['creditnotein__lastupdate'];?></td><td><?=$row['creditnotein__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_credit_note_inview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_credit_note_inview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_credit_note_inedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_credit_note_inedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_credit_note_inconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_credit_note_ingotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#mark_as_used').click(function(){var data = $('#open_credit_note_inlistform').serialize();$.ajax({type: 'POST',url: '<?=site_url();?>/creditnotein_usedflag',data: data,success: function (resp) {var options = { 	target:        '#open_credit_note_inlist',	success: 		open_credit_note_inshowResponse,}; $('#open_credit_note_inlistform').ajaxSubmit(options);},});});});</script><input id='mark_as_used' type="submit" value="Mark As Used">
			
		</form>
		</div>