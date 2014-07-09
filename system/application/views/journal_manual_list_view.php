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
					target:        '#journal_manuallist',
					success: 		journal_manualshowResponse,
		}; 
		
		$('#journal_manuallistform').submit(function() { 
			$('#journal_manuallistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function journal_manualconfirmdelete(delid, obj)
	{
		$('#journal_manual-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', journal_manualconfirmdelete2(delid, obj));
	}
	
	function journal_manualconfirmdelete2(delid, obj)
	{
		$( "#journal_manual-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					journal_manualcalldeletefn('journal_manualdelete', delid, 'journal_manuallist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#journal_manual-dialog-confirm').html('');
	}
	
	function journal_manualsortupdown(field, direction)
	{
		$("#journal_manualcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#journal_manuallist',
					success: 		journal_manualshowResponse,
		}; 
		$('#journal_manuallistform').ajaxSubmit(options);
		return false;
	}
	
	function journal_manualshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#journal_manuallist',
					success: 		journal_manualshowResponse,
		}; 
		
		$('#journal_manuallistform').submit(function() { 
			$('#journal_manuallistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function journal_manualcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function journal_manualadd()
	{
		$('#journal_manualformholder').load('<?=site_url()."/journal_manualadd/";?>', function()
		{$('#journal_manualclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journal_manualformholder' + '\').html(\'\');' + '$(\'' + '#journal_manualclosebutton' + '\').html(\'\');' + '$(\'' + '#journal_manuallist' + '\').load(\'<?=site_url();?>/journal_manuallist\');' + ';"></input>');
		});	
	}
	
	function journal_manualedit(id)
	{
		$('#journal_manualformholder').load('<?=site_url()."/journal_manualedit/index/";?>' + id, function()
		{$('#journal_manualclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journal_manualformholder' + '\').html(\'\');' + '$(\'' + '#journal_manualclosebutton' + '\').html(\'\');' + '$(\'' + '#journal_manuallist' + '\').load(\'<?=site_url();?>/journal_manuallist\');' + ';"></input>');
		});	
	}
	
	function journal_manualview(id)
	{
		$('#journal_manualformholder').load('<?=site_url()."/journal_manualview/index/";?>' + id, function()
		{$('#journal_manualclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#journal_manualformholder' + '\').html(\'\');' + '$(\'' + '#journal_manualclosebutton' + '\').html(\'\');' + '$(\'' + '#journal_manuallist' + '\').load(\'<?=site_url();?>/journal_manuallist\');' + ';"></input>');
		});	
	}
	
	function journal_manualgotopage()
	{
		var page = document.journal_manuallistform.pageno.options[document.journal_manuallistform.pageno.selectedIndex].value;
		
		$("#journal_manualcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#journal_manuallist',
					success: 		journal_manualshowResponse,
		}; 
		$('#journal_manuallistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="journal_manual-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="journal_manualclosebutton"></div>
		<div id="journal_manualformholder"></div>
		<div id="journal_manuallist">
		<!--<form method="post" action="<?=site_url();?>/journal_manuallist/index/" id="journal_manuallistform" name="journal_manuallistform">-->
		<form method="post" action="<?=current_url();?>" id="journal_manuallistform" name="journal_manuallistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="journal_manualcurrsort">
			</div>
			<div id="journal_manualsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="journal_manualadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/journal_manualadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/journal_manualadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="journal_manualsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="journal_manualsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="journal_manualsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="journal_manualsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/journal_manualview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('journal_manualview/index/'.$row['id'], $row['journalmanual__reference']);?></td><td><?=$row['journalmanual__date'];?></td><td><?=$row['journalmanual__notes'];?></td><td><?=$row['journalmanual__lastupdate'];?></td><td><?=$row['journalmanual__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="journal_manualview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/journal_manualview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="journal_manualedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/journal_manualedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="journal_manualconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="journal_manualgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>