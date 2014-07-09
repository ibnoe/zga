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
					target:        '#journallist',
					success: 		journalshowResponse,
		}; 
		
		$('#journallistform').submit(function() { 
			$('#journallistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function journalconfirmdelete(delid, obj)
	{
		$('#journal-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', journalconfirmdelete2(delid, obj));
	}
	
	function journalconfirmdelete2(delid, obj)
	{
		$( "#journal-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					journalcalldeletefn('journaldelete', delid, 'journallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal-dialog-confirm').html('');
	}
	
	function journalsortupdown(field, direction)
	{
		$("#journalcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#journallist',
					success: 		journalshowResponse,
		}; 
		$('#journallistform').ajaxSubmit(options);
		return false;
	}
	
	function journalshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#journallist',
					success: 		journalshowResponse,
		}; 
		
		$('#journallistform').submit(function() { 
			$('#journallistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function journalcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function journaladd()
	{
		$('#journalformholder').load('<?=site_url()."/journaladd/";?>', function()
		{$('#journalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journalformholder' + '\').html(\'\');' + '$(\'' + '#journalclosebutton' + '\').html(\'\');' + '$(\'' + '#journallist' + '\').load(\'<?=site_url();?>/journallist\');' + ';"></input>');
		});	
	}
	
	function journaledit(id)
	{
		$('#journalformholder').load('<?=site_url()."/journaledit/index/";?>' + id, function()
		{$('#journalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journalformholder' + '\').html(\'\');' + '$(\'' + '#journalclosebutton' + '\').html(\'\');' + '$(\'' + '#journallist' + '\').load(\'<?=site_url();?>/journallist\');' + ';"></input>');
		});	
	}
	
	function journalview(id)
	{
		$('#journalformholder').load('<?=site_url()."/journalview/index/";?>' + id, function()
		{$('#journalclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journalformholder' + '\').html(\'\');' + '$(\'' + '#journalclosebutton' + '\').html(\'\');' + '$(\'' + '#journallist' + '\').load(\'<?=site_url();?>/journallist\');' + ';"></input>');
		});	
	}
	
	function journalgotopage()
	{
		var page = document.journallistform.pageno.options[document.journallistform.pageno.selectedIndex].value;
		
		$("#journalcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#journallist',
					success: 		journalshowResponse,
		}; 
		$('#journallistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="journal-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="journalclosebutton"></div>
		<div id="journalformholder"></div>
		<div id="journallist">
		<!--<form method="post" action="<?=site_url();?>/journallist/index/" id="journallistform" name="journallistform">-->
		<form method="post" action="<?=current_url();?>" id="journallistform" name="journallistform" class="listform">
		
			<script type="text/javascript">$(document).ready(function() {$('#accountfilter').change(function() { $('#journallistform').submit();});});</script>Account:&nbsp;<?=form_dropdown('coa_id', $coa_opt, $coa_id, 'id="accountfilter"');?>&nbsp;<script type="text/javascript">$(document).ready(function() {$('#datefilter').change(function() { $('#journallistform').submit();});});</script>Date:&nbsp;<?=form_dropdown('date', $date_opt, $date, 'id="datefilter"');?>&nbsp;
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="journalcurrsort">
			</div>
			<div id="journalsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="journaladd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/journaladd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/journaladd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="journalsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="journalsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="journalsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="journalsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/journalview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['journal__reference'];?></td><td><?=$row['journal__date'];?></td><td><?php if (isset($row['journal__coa_id']) && $row['coa__name'] != "") echo anchor('accountsview/index/'.$row['journal__coa_id'], $row['coa__name']);?></td><td align='right'><?=number_format($row['journal__debit'], 2);?></td><td align='right'><?=number_format($row['journal__credit'], 2);?></td><td><?=$row['journal__notes'];?></td><td><?=$row['journal__lastupdate'];?></td><td><?=$row['journal__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="journalview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/journalview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="journaledit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/journaledit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="journalconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="journalgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>