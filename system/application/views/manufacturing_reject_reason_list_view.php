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
					target:        '#manufacturing_reject_reasonlist',
					success: 		manufacturing_reject_reasonshowResponse,
		}; 
		
		$('#manufacturing_reject_reasonlistform').submit(function() { 
			$('#manufacturing_reject_reasonlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function manufacturing_reject_reasonconfirmdelete(delid, obj)
	{
		$('#manufacturing_reject_reason-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', manufacturing_reject_reasonconfirmdelete2(delid, obj));
	}
	
	function manufacturing_reject_reasonconfirmdelete2(delid, obj)
	{
		$( "#manufacturing_reject_reason-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					manufacturing_reject_reasoncalldeletefn('manufacturing_reject_reasondelete', delid, 'manufacturing_reject_reasonlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#manufacturing_reject_reason-dialog-confirm').html('');
	}
	
	function manufacturing_reject_reasonsortupdown(field, direction)
	{
		$("#manufacturing_reject_reasoncurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#manufacturing_reject_reasonlist',
					success: 		manufacturing_reject_reasonshowResponse,
		}; 
		$('#manufacturing_reject_reasonlistform').ajaxSubmit(options);
		return false;
	}
	
	function manufacturing_reject_reasonshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#manufacturing_reject_reasonlist',
					success: 		manufacturing_reject_reasonshowResponse,
		}; 
		
		$('#manufacturing_reject_reasonlistform').submit(function() { 
			$('#manufacturing_reject_reasonlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function manufacturing_reject_reasoncalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function manufacturing_reject_reasonadd()
	{
		$('#manufacturing_reject_reasonformholder').load('<?=site_url()."/manufacturing_reject_reasonadd/";?>', function()
		{$('#manufacturing_reject_reasonclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_reject_reasonformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_reject_reasonclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_reject_reasonlist' + '\').load(\'<?=site_url();?>/manufacturing_reject_reasonlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_reject_reasonedit(id)
	{
		$('#manufacturing_reject_reasonformholder').load('<?=site_url()."/manufacturing_reject_reasonedit/index/";?>' + id, function()
		{$('#manufacturing_reject_reasonclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_reject_reasonformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_reject_reasonclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_reject_reasonlist' + '\').load(\'<?=site_url();?>/manufacturing_reject_reasonlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_reject_reasonview(id)
	{
		$('#manufacturing_reject_reasonformholder').load('<?=site_url()."/manufacturing_reject_reasonview/index/";?>' + id, function()
		{$('#manufacturing_reject_reasonclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#manufacturing_reject_reasonformholder' + '\').html(\'\');' + '$(\'' + '#manufacturing_reject_reasonclosebutton' + '\').html(\'\');' + '$(\'' + '#manufacturing_reject_reasonlist' + '\').load(\'<?=site_url();?>/manufacturing_reject_reasonlist\');' + ';"></input>');
		});	
	}
	
	function manufacturing_reject_reasongotopage()
	{
		var page = document.manufacturing_reject_reasonlistform.pageno.options[document.manufacturing_reject_reasonlistform.pageno.selectedIndex].value;
		
		$("#manufacturing_reject_reasoncurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#manufacturing_reject_reasonlist',
					success: 		manufacturing_reject_reasonshowResponse,
		}; 
		$('#manufacturing_reject_reasonlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="manufacturing_reject_reason-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="manufacturing_reject_reasonclosebutton"></div>
		<div id="manufacturing_reject_reasonformholder"></div>
		<div id="manufacturing_reject_reasonlist">
		<!--<form method="post" action="<?=site_url();?>/manufacturing_reject_reasonlist/index/" id="manufacturing_reject_reasonlistform" name="manufacturing_reject_reasonlistform">-->
		<form method="post" action="<?=current_url();?>" id="manufacturing_reject_reasonlistform" name="manufacturing_reject_reasonlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="manufacturing_reject_reasoncurrsort">
			</div>
			<div id="manufacturing_reject_reasonsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="manufacturing_reject_reasonadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_reject_reasonadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/manufacturing_reject_reasonadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="manufacturing_reject_reasonsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="manufacturing_reject_reasonsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="manufacturing_reject_reasonsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="manufacturing_reject_reasonsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/manufacturing_reject_reasonview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('manufacturing_reject_reasonview/index/'.$row['id'], $row['manufacturingrejectreason__name']);?></td><td><?=$row['manufacturingrejectreason__name'];?></td><td><?=$row['manufacturingrejectreason__lastupdate'];?></td><td><?=$row['manufacturingrejectreason__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="manufacturing_reject_reasonview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/manufacturing_reject_reasonview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="manufacturing_reject_reasonedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/manufacturing_reject_reasonedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="manufacturing_reject_reasonconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="manufacturing_reject_reasongotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>