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
					target:        '#credit_note_outlist',
					success: 		credit_note_outshowResponse,
		}; 
		
		$('#credit_note_outlistform').submit(function() { 
			$('#credit_note_outlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function credit_note_outconfirmdelete(delid, obj)
	{
		$('#credit_note_out-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', credit_note_outconfirmdelete2(delid, obj));
	}
	
	function credit_note_outconfirmdelete2(delid, obj)
	{
		$( "#credit_note_out-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					credit_note_outcalldeletefn('credit_note_outdelete', delid, 'credit_note_outlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#credit_note_out-dialog-confirm').html('');
	}
	
	function credit_note_outsortupdown(field, direction)
	{
		$("#credit_note_outcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#credit_note_outlist',
					success: 		credit_note_outshowResponse,
		}; 
		$('#credit_note_outlistform').ajaxSubmit(options);
		return false;
	}
	
	function credit_note_outshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#credit_note_outlist',
					success: 		credit_note_outshowResponse,
		}; 
		
		$('#credit_note_outlistform').submit(function() { 
			$('#credit_note_outlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function credit_note_outcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function credit_note_outadd()
	{
		$('#credit_note_outformholder').load('<?=site_url()."/credit_note_outadd/";?>', function()
		{$('#credit_note_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#credit_note_outformholder' + '\').html(\'\');' + '$(\'' + '#credit_note_outclosebutton' + '\').html(\'\');' + '$(\'' + '#credit_note_outlist' + '\').load(\'<?=site_url();?>/credit_note_outlist\');' + ';"></input>');
		});	
	}
	
	function credit_note_outedit(id)
	{
		$('#credit_note_outformholder').load('<?=site_url()."/credit_note_outedit/index/";?>' + id, function()
		{$('#credit_note_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#credit_note_outformholder' + '\').html(\'\');' + '$(\'' + '#credit_note_outclosebutton' + '\').html(\'\');' + '$(\'' + '#credit_note_outlist' + '\').load(\'<?=site_url();?>/credit_note_outlist\');' + ';"></input>');
		});	
	}
	
	function credit_note_outview(id)
	{
		$('#credit_note_outformholder').load('<?=site_url()."/credit_note_outview/index/";?>' + id, function()
		{$('#credit_note_outclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#credit_note_outformholder' + '\').html(\'\');' + '$(\'' + '#credit_note_outclosebutton' + '\').html(\'\');' + '$(\'' + '#credit_note_outlist' + '\').load(\'<?=site_url();?>/credit_note_outlist\');' + ';"></input>');
		});	
	}
	
	function credit_note_outgotopage()
	{
		var page = document.credit_note_outlistform.pageno.options[document.credit_note_outlistform.pageno.selectedIndex].value;
		
		$("#credit_note_outcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#credit_note_outlist',
					success: 		credit_note_outshowResponse,
		}; 
		$('#credit_note_outlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="credit_note_out-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="credit_note_outclosebutton"></div>
		<div id="credit_note_outformholder"></div>
		<div id="credit_note_outlist">
		<!--<form method="post" action="<?=site_url();?>/credit_note_outlist/index/" id="credit_note_outlistform" name="credit_note_outlistform">-->
		<form method="post" action="<?=current_url();?>" id="credit_note_outlistform" name="credit_note_outlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="credit_note_outcurrsort">
			</div>
			<div id="credit_note_outsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="credit_note_outadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/credit_note_outadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/credit_note_outadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="credit_note_outsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="credit_note_outsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="credit_note_outsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="credit_note_outsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/credit_note_outview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('credit_note_outview/index/'.$row['id'], $row['creditnoteout__creditnoteoutid']);?></td><td><?=$row['creditnoteout__date'];?></td><td><?=$row['creditnoteout__expirydate'];?></td><td><?php if (isset($row['creditnoteout__customer_id']) && $row['customer__firstname'] != "") echo anchor('customerview/index/'.$row['creditnoteout__customer_id'], $row['customer__firstname']);?></td><td><?php if (isset($row['creditnoteout__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['creditnoteout__coa_id'], $row['coa__name']);?></td><td><?php if (isset($row['creditnoteout__currency_id']) && $row['currency__name'] != "") echo anchor('currencyview/index/'.$row['creditnoteout__currency_id'], $row['currency__name']);?></td><td align='right'><?=number_format($row['creditnoteout__amount'], 2);?></td><td align='right'><?=number_format($row['creditnoteout__amountused'], 2);?></td><td><?=$row['creditnoteout__notes'];?></td><td><?php if ($row['creditnoteout__usedflag'] != 0) echo 'Yes'; else echo '';?></td><td><?=$row['creditnoteout__lastupdate'];?></td><td><?=$row['creditnoteout__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="credit_note_outview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/credit_note_outview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="credit_note_outedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/credit_note_outedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="credit_note_outconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="credit_note_outgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>