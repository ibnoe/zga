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
					target:        '#open_credit_note_outlist',
					success: 		open_credit_note_outshowResponse,
		}; 
		
		$('#open_credit_note_outlistform').submit(function() { 
			$('#open_credit_note_outlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function open_credit_note_outconfirmdelete(delid, obj)
	{
		$('#open_credit_note_out-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', open_credit_note_outconfirmdelete2(delid, obj));
	}
	
	function open_credit_note_outconfirmdelete2(delid, obj)
	{
		$( "#open_credit_note_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					open_credit_note_outcalldeletefn('open_credit_note_outdelete', delid, 'open_credit_note_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#open_credit_note_out-dialog-confirm').html('');
	}
	
	function open_credit_note_outsortupdown(field, direction)
	{
		$("#open_credit_note_outcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#open_credit_note_outlist',
					success: 		open_credit_note_outshowResponse,
		}; 
		$('#open_credit_note_outlistform').ajaxSubmit(options);
		return false;
	}
	
	function open_credit_note_outshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#open_credit_note_outlist',
					success: 		open_credit_note_outshowResponse,
		}; 
		
		$('#open_credit_note_outlistform').submit(function() { 
			$('#open_credit_note_outlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function open_credit_note_outcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function open_credit_note_outadd()
	{
		$('#open_credit_note_outformholder').load('<?=site_url()."/open_credit_note_outadd/";?>', function()
		{$('#open_credit_note_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_credit_note_outformholder' + '\').html(\'\');' + '$(\'' + '#open_credit_note_outclosebutton' + '\').html(\'\');' + '$(\'' + '#open_credit_note_outlist' + '\').load(\'<?=site_url();?>/open_credit_note_outlist\');' + ';"></input>');
		});	
	}
	
	function open_credit_note_outedit(id)
	{
		$('#open_credit_note_outformholder').load('<?=site_url()."/open_credit_note_outedit/index/";?>' + id, function()
		{$('#open_credit_note_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_credit_note_outformholder' + '\').html(\'\');' + '$(\'' + '#open_credit_note_outclosebutton' + '\').html(\'\');' + '$(\'' + '#open_credit_note_outlist' + '\').load(\'<?=site_url();?>/open_credit_note_outlist\');' + ';"></input>');
		});	
	}
	
	function open_credit_note_outview(id)
	{
		$('#open_credit_note_outformholder').load('<?=site_url()."/open_credit_note_outview/index/";?>' + id, function()
		{$('#open_credit_note_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#open_credit_note_outformholder' + '\').html(\'\');' + '$(\'' + '#open_credit_note_outclosebutton' + '\').html(\'\');' + '$(\'' + '#open_credit_note_outlist' + '\').load(\'<?=site_url();?>/open_credit_note_outlist\');' + ';"></input>');
		});	
	}
	
	function open_credit_note_outgotopage()
	{
		var page = document.open_credit_note_outlistform.pageno.options[document.open_credit_note_outlistform.pageno.selectedIndex].value;
		
		$("#open_credit_note_outcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#open_credit_note_outlist',
					success: 		open_credit_note_outshowResponse,
		}; 
		$('#open_credit_note_outlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="open_credit_note_out-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="open_credit_note_outclosebutton"></div>
		<div id="open_credit_note_outformholder"></div>
		<div id="open_credit_note_outlist">
		<!--<form method="post" action="<?=site_url();?>/open_credit_note_outlist/index/" id="open_credit_note_outlistform" name="open_credit_note_outlistform">-->
		<form method="post" action="<?=current_url();?>" id="open_credit_note_outlistform" name="open_credit_note_outlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="open_credit_note_outcurrsort">
			</div>
			<div id="open_credit_note_outsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="open_credit_note_outadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_credit_note_outadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/open_credit_note_outadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="open_credit_note_outsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="open_credit_note_outsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="open_credit_note_outsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="open_credit_note_outsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?= form_checkbox('creditnoteout__id[]', $row['creditnoteout__id'], false);?></td><td><?=$row['creditnoteout__creditnoteoutid'];?></td><td><?=$row['creditnoteout__date'];?></td><td><?=$row['creditnoteout__expirydate'];?></td><td><?php if (isset($row['creditnoteout__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['creditnoteout__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['creditnoteout__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['creditnoteout__coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['creditnoteout__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['creditnoteout__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['creditnoteout__amount'], 2);?></td><td align='right'><?=number_format($row['creditnoteout__amountused'], 2);?></td><td><?=$row['creditnoteout__notes'];?></td><td><?php if ($row['creditnoteout__usedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['creditnoteout__lastupdate'];?></td><td><?=$row['creditnoteout__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="open_credit_note_outview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/open_credit_note_outview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="open_credit_note_outedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/open_credit_note_outedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="open_credit_note_outconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="open_credit_note_outgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br><script type="text/javascript">$(document).ready(function() {$('#mark_as_used').click(function(){var data = $('#open_credit_note_outlistform').serialize();$.ajax({type: 'POST',url: '<?=site_url();?>/creditnoteout_usedflag',data: data,success: function (resp) {var options = { 	target:        '#open_credit_note_outlist',	success: 		open_credit_note_outshowResponse,}; $('#open_credit_note_outlistform').ajaxSubmit(options);},});});});</script><input id='mark_as_used' type="submit" value="Mark As Used">
			
		</form>
		</div>