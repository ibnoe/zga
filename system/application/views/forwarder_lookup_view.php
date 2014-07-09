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
					target:        '#forwarderlist',
					success: 		forwardershowResponse,
		}; 
		
		$('#forwarderlistform').submit(function() { 
			$('#forwarderlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function forwarderconfirmdelete(delid, obj)
	{
		$('#forwarder-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', forwarderconfirmdelete2(delid, obj));
	}
	
	function forwarderconfirmdelete2(delid, obj)
	{
		$( "#forwarder-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					forwardercalldeletefn('forwarderdelete', delid, 'forwarderlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#forwarder-dialog-confirm').html('');
	}
	
	function forwardersortupdown(field, direction)
	{
		$("#forwardercurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#forwarderlist',
					success: 		forwardershowResponse,
		}; 
		$('#forwarderlistform').ajaxSubmit(options);
		return false;
	}
	
	function forwardershowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#forwarderlist',
					success: 		forwardershowResponse,
		}; 
		
		$('#forwarderlistform').submit(function() { 
			$('#forwarderlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function forwardercalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function forwarderadd()
	{
		$('#forwarderformholder').load('<?=site_url()."/forwarderadd/";?>', function()
		{$('#forwarderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#forwarderformholder' + '\').html(\'\');' + '$(\'' + '#forwarderclosebutton' + '\').html(\'\');' + '$(\'' + '#forwarderlist' + '\').load(\'<?=site_url();?>/forwarderlist\');' + ';"></input>');
		});	
	}
	
	function forwarderedit(id)
	{
		$('#forwarderformholder').load('<?=site_url()."/forwarderedit/index/";?>' + id, function()
		{$('#forwarderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#forwarderformholder' + '\').html(\'\');' + '$(\'' + '#forwarderclosebutton' + '\').html(\'\');' + '$(\'' + '#forwarderlist' + '\').load(\'<?=site_url();?>/forwarderlist\');' + ';"></input>');
		});	
	}
	
	function forwarderview(id)
	{
		$('#forwarderformholder').load('<?=site_url()."/forwarderview/index/";?>' + id, function()
		{$('#forwarderclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#forwarderformholder' + '\').html(\'\');' + '$(\'' + '#forwarderclosebutton' + '\').html(\'\');' + '$(\'' + '#forwarderlist' + '\').load(\'<?=site_url();?>/forwarderlist\');' + ';"></input>');
		});	
	}
	
	function forwardergotopage()
	{
		var page = document.forwarderlistform.pageno.options[document.forwarderlistform.pageno.selectedIndex].value;
		
		$("#forwardercurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#forwarderlist',
					success: 		forwardershowResponse,
		}; 
		$('#forwarderlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="forwarder-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="forwarderclosebutton"></div>
		<div id="forwarderformholder"></div>
		<div id="forwarderlist">
		<!--<form method="post" action="<?=site_url();?>/forwarderlist/index/" id="forwarderlistform" name="forwarderlistform">-->
		<form method="post" action="<?=current_url();?>" id="forwarderlistform" name="forwarderlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="forwardercurrsort">
			</div>
			<div id="forwardersort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="forwarderadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/forwarderadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/forwarderadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="forwardersortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="forwardersortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (false): ?>
								<a href="#" class="updown" onclick="forwardersortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="forwardersortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					
					<td class='hidden'><?=$row['id'];?></td><td><?=$row['forwarder__name'];?></td><td><?=$row['forwarder__address'];?></td><td align='right'><?=number_format($row['forwarder__rating'], 2);?></td><td><?=$row['forwarder__notes'];?></td><td><?=$row['forwarder__lastupdate'];?></td><td><?=$row['forwarder__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="forwarderview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/forwarderview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="forwarderedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/forwarderedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="forwarderconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (false && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="forwardergotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>