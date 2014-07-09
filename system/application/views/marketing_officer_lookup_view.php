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
					target:        '#marketing_officerlist',
					success: 		marketing_officershowResponse,
		}; 
		
		$('#marketing_officerlistform').submit(function() { 
			$('#marketing_officerlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function marketing_officerconfirmdelete(delid, obj)
	{
		$('#marketing_officer-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', marketing_officerconfirmdelete2(delid, obj));
	}
	
	function marketing_officerconfirmdelete2(delid, obj)
	{
		$( "#marketing_officer-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					marketing_officercalldeletefn('marketing_officerdelete', delid, 'marketing_officerlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#marketing_officer-dialog-confirm').html('');
	}
	
	function marketing_officersortupdown(field, direction)
	{
		$("#marketing_officercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#marketing_officerlist',
					success: 		marketing_officershowResponse,
		}; 
		$('#marketing_officerlistform').ajaxSubmit(options);
		return false;
	}
	
	function marketing_officershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#marketing_officerlist',
					success: 		marketing_officershowResponse,
		}; 
		
		$('#marketing_officerlistform').submit(function() { 
			$('#marketing_officerlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function marketing_officercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function marketing_officeradd()
	{
		$('#marketing_officerformholder').load('<?=site_url()."/marketing_officeradd/";?>', function()
		{$('#marketing_officerclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#marketing_officerformholder' + '\').html(\'\');' + '$(\'' + '#marketing_officerclosebutton' + '\').html(\'\');' + '$(\'' + '#marketing_officerlist' + '\').load(\'<?=site_url();?>/marketing_officerlist\');' + ';"></input>');
		});	
	}
	
	function marketing_officeredit(id)
	{
		$('#marketing_officerformholder').load('<?=site_url()."/marketing_officeredit/index/";?>' + id, function()
		{$('#marketing_officerclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#marketing_officerformholder' + '\').html(\'\');' + '$(\'' + '#marketing_officerclosebutton' + '\').html(\'\');' + '$(\'' + '#marketing_officerlist' + '\').load(\'<?=site_url();?>/marketing_officerlist\');' + ';"></input>');
		});	
	}
	
	function marketing_officerview(id)
	{
		$('#marketing_officerformholder').load('<?=site_url()."/marketing_officerview/index/";?>' + id, function()
		{$('#marketing_officerclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#marketing_officerformholder' + '\').html(\'\');' + '$(\'' + '#marketing_officerclosebutton' + '\').html(\'\');' + '$(\'' + '#marketing_officerlist' + '\').load(\'<?=site_url();?>/marketing_officerlist\');' + ';"></input>');
		});	
	}
	
	function marketing_officergotopage()
	{
		var page = document.marketing_officerlistform.pageno.options[document.marketing_officerlistform.pageno.selectedIndex].value;
		
		$("#marketing_officercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#marketing_officerlist',
					success: 		marketing_officershowResponse,
		}; 
		$('#marketing_officerlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="marketing_officer-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="marketing_officerclosebutton"></div>
		<div id="marketing_officerformholder"></div>
		<div id="marketing_officerlist">
		<!--<form method="post" action="<?=site_url();?>/marketing_officerlist/index/" id="marketing_officerlistform" name="marketing_officerlistform">-->
		<form method="post" action="<?=current_url();?>" id="marketing_officerlistform" name="marketing_officerlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="marketing_officercurrsort">
			</div>
			<div id="marketing_officersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="marketing_officeradd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/marketing_officeradd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/marketing_officeradd/index/";?>')">
				<?php endif; ?>
			<?php endif; ?>
			
			<table class="main">

				<tr>
				
				
				
				<?php foreach ($fields as $k=>$v): ?>
					<th>
						<?=$v;?><br/>
						<?php if (in_array($k, $sortby))
						{
							$index = array_search($k, $sortby);
							if (false)
							{
								if ($sortdirection[$index] == "asc")
								{
									echo '<a href="#" class="updown" onclick="marketing_officersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="marketing_officersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="marketing_officersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="marketing_officersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['marketingofficer__idstring'];?></td><td><?=$row['marketingofficer__name'];?></td><td><?=$row['marketingofficer__notes'];?></td><td><?=$row['marketingofficer__lastupdate'];?></td><td><?=$row['marketingofficer__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="marketing_officerview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/marketing_officerview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="marketing_officeredit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/marketing_officeredit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="marketing_officerconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="marketing_officergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>