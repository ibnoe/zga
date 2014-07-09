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
					target:        '#giro_out_clearancelist',
					success: 		giro_out_clearanceshowResponse,
		}; 
		
		$('#giro_out_clearancelistform').submit(function() { 
			$('#giro_out_clearancelistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function giro_out_clearanceconfirmdelete(delid, obj)
	{
		$('#giro_out_clearance-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', giro_out_clearanceconfirmdelete2(delid, obj));
	}
	
	function giro_out_clearanceconfirmdelete2(delid, obj)
	{
		$( "#giro_out_clearance-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					giro_out_clearancecalldeletefn('giro_out_clearancedelete', delid, 'giro_out_clearancelist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#giro_out_clearance-dialog-confirm').html('');
	}
	
	function giro_out_clearancesortupdown(field, direction)
	{
		$("#giro_out_clearancecurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#giro_out_clearancelist',
					success: 		giro_out_clearanceshowResponse,
		}; 
		$('#giro_out_clearancelistform').ajaxSubmit(options);
		return false;
	}
	
	function giro_out_clearanceshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#giro_out_clearancelist',
					success: 		giro_out_clearanceshowResponse,
		}; 
		
		$('#giro_out_clearancelistform').submit(function() { 
			$('#giro_out_clearancelistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function giro_out_clearancecalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function giro_out_clearanceadd()
	{
		$('#giro_out_clearanceformholder').load('<?=site_url()."/giro_out_clearanceadd/";?>', function()
		{$('#giro_out_clearanceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_out_clearanceformholder' + '\').html(\'\');' + '$(\'' + '#giro_out_clearanceclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_out_clearancelist' + '\').load(\'<?=site_url();?>/giro_out_clearancelist\');' + ';"></input>');
		});	
	}
	
	function giro_out_clearanceedit(id)
	{
		$('#giro_out_clearanceformholder').load('<?=site_url()."/giro_out_clearanceedit/index/";?>' + id, function()
		{$('#giro_out_clearanceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_out_clearanceformholder' + '\').html(\'\');' + '$(\'' + '#giro_out_clearanceclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_out_clearancelist' + '\').load(\'<?=site_url();?>/giro_out_clearancelist\');' + ';"></input>');
		});	
	}
	
	function giro_out_clearanceview(id)
	{
		$('#giro_out_clearanceformholder').load('<?=site_url()."/giro_out_clearanceview/index/";?>' + id, function()
		{$('#giro_out_clearanceclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#giro_out_clearanceformholder' + '\').html(\'\');' + '$(\'' + '#giro_out_clearanceclosebutton' + '\').html(\'\');' + '$(\'' + '#giro_out_clearancelist' + '\').load(\'<?=site_url();?>/giro_out_clearancelist\');' + ';"></input>');
		});	
	}
	
	function giro_out_clearancegotopage()
	{
		var page = document.giro_out_clearancelistform.pageno.options[document.giro_out_clearancelistform.pageno.selectedIndex].value;
		
		$("#giro_out_clearancecurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#giro_out_clearancelist',
					success: 		giro_out_clearanceshowResponse,
		}; 
		$('#giro_out_clearancelistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="giro_out_clearance-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="giro_out_clearanceclosebutton"></div>
		<div id="giro_out_clearanceformholder"></div>
		<div id="giro_out_clearancelist">
		<!--<form method="post" action="<?=site_url();?>/giro_out_clearancelist/index/" id="giro_out_clearancelistform" name="giro_out_clearancelistform">-->
		<form method="post" action="<?=current_url();?>" id="giro_out_clearancelistform" name="giro_out_clearancelistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="giro_out_clearancecurrsort">
			</div>
			<div id="giro_out_clearancesort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (false): ?>
				<!--<input type="button" value="New" onclick="giro_out_clearanceadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_out_clearanceadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/giro_out_clearanceadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="giro_out_clearancesortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="giro_out_clearancesortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="giro_out_clearancesortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="giro_out_clearancesortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/giro_out_clearanceview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('giro_out_clearanceview/index/'.$row['id'], $row['girooutclearance__date']);?></td><td><?=$row['girooutclearance__idstring'];?></td><td><?=$row['girooutclearance__notes'];?></td><td><?=$row['girooutclearance__lastupdate'];?></td><td><?=$row['girooutclearance__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="giro_out_clearanceview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/giro_out_clearanceview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="giro_out_clearanceedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/giro_out_clearanceedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="giro_out_clearanceconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="giro_out_clearancegotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>