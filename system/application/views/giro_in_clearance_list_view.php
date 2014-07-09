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
					target:        '#giro_in_clearancelist',
					success: 		giro_in_clearanceshowResponse,
		}; 
		
		$('#giro_in_clearancelistform').submit(function() { 
			$('#giro_in_clearancelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function giro_in_clearanceconfirmdelete(delid, obj)
	{
		$('#giro_in_clearance-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_in_clearanceconfirmdelete2(delid, obj));
	}
	
	function giro_in_clearanceconfirmdelete2(delid, obj)
	{
		$( "#giro_in_clearance-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_in_clearancecalldeletefn('giro_in_clearancedelete', delid, 'giro_in_clearancelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_in_clearance-dialog-confirm').html('');
	}
	
	function giro_in_clearancesortupdown(field, direction)
	{
		$("#giro_in_clearancecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#giro_in_clearancelist',
					success: 		giro_in_clearanceshowResponse,
		}; 
		$('#giro_in_clearancelistform').ajaxSubmit(options);
		return false;
	}
	
	function giro_in_clearanceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#giro_in_clearancelist',
					success: 		giro_in_clearanceshowResponse,
		}; 
		
		$('#giro_in_clearancelistform').submit(function() { 
			$('#giro_in_clearancelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function giro_in_clearancecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function giro_in_clearanceadd()
	{
		$('#giro_in_clearanceformholder').load('<?=site_url()."/giro_in_clearanceadd/";?>', function()
		{$('#giro_in_clearanceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearanceformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearanceclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearancelist' + '\').load(\'<?=site_url();?>/giro_in_clearancelist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearanceedit(id)
	{
		$('#giro_in_clearanceformholder').load('<?=site_url()."/giro_in_clearanceedit/index/";?>' + id, function()
		{$('#giro_in_clearanceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearanceformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearanceclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearancelist' + '\').load(\'<?=site_url();?>/giro_in_clearancelist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearanceview(id)
	{
		$('#giro_in_clearanceformholder').load('<?=site_url()."/giro_in_clearanceview/index/";?>' + id, function()
		{$('#giro_in_clearanceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_in_clearanceformholder' + '\').html(\'\');' + '$(\'' + '#giro_in_clearanceclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_in_clearancelist' + '\').load(\'<?=site_url();?>/giro_in_clearancelist\');' + ';"></input>');
		});	
	}
	
	function giro_in_clearancegotopage()
	{
		var page = document.giro_in_clearancelistform.pageno.options[document.giro_in_clearancelistform.pageno.selectedIndex].value;
		
		$("#giro_in_clearancecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#giro_in_clearancelist',
					success: 		giro_in_clearanceshowResponse,
		}; 
		$('#giro_in_clearancelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="giro_in_clearance-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="giro_in_clearanceclosebutton"></div>
		<div id="giro_in_clearanceformholder"></div>
		<div id="giro_in_clearancelist">
		<!--<form method="post" action="<?=site_url();?>/giro_in_clearancelist/index/" id="giro_in_clearancelistform" name="giro_in_clearancelistform">-->
		<form method="post" action="<?=current_url();?>" id="giro_in_clearancelistform" name="giro_in_clearancelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="giro_in_clearancecurrsort">
			</div>
			<div id="giro_in_clearancesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="giro_in_clearanceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_in_clearanceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_in_clearanceadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="giro_in_clearancesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="giro_in_clearancesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="giro_in_clearancesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="giro_in_clearancesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/giro_in_clearanceview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('giro_in_clearanceview/index/'.$row['id'], $row['giroinclearance__date']);?></td><td><?=$row['giroinclearance__idstring'];?></td><td><?=$row['giroinclearance__notes'];?></td><td><?=$row['giroinclearance__lastupdate'];?></td><td><?=$row['giroinclearance__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="giro_in_clearanceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/giro_in_clearanceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="giro_in_clearanceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_in_clearanceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_in_clearanceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="giro_in_clearancegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>