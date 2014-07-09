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
					target:        '#uomlist',
					success: 		uomshowResponse,
		}; 
		
		$('#uomlistform').submit(function() { 
			$('#uomlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function uomconfirmdelete(delid, obj)
	{
		$('#uom-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', uomconfirmdelete2(delid, obj));
	}
	
	function uomconfirmdelete2(delid, obj)
	{
		$( "#uom-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					uomcalldeletefn('uomdelete', delid, 'uomlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#uom-dialog-confirm').html('');
	}
	
	function uomsortupdown(field, direction)
	{
		$("#uomcurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#uomlist',
					success: 		uomshowResponse,
		}; 
		$('#uomlistform').ajaxSubmit(options);
		return false;
	}
	
	function uomshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#uomlist',
					success: 		uomshowResponse,
		}; 
		
		$('#uomlistform').submit(function() { 
			$('#uomlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function uomcalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function uomadd()
	{
		$('#uomformholder').load('<?=site_url()."/uomadd/";?>', function()
		{$('#uomclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#uomformholder' + '\').html(\'\');' + '$(\'' + '#uomclosebutton' + '\').html(\'\');' + '$(\'' + '#uomlist' + '\').load(\'<?=site_url();?>/uomlist\');' + ';"></input>');
		});	
	}
	
	function uomedit(id)
	{
		$('#uomformholder').load('<?=site_url()."/uomedit/index/";?>' + id, function()
		{$('#uomclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#uomformholder' + '\').html(\'\');' + '$(\'' + '#uomclosebutton' + '\').html(\'\');' + '$(\'' + '#uomlist' + '\').load(\'<?=site_url();?>/uomlist\');' + ';"></input>');
		});	
	}
	
	function uomview(id)
	{
		$('#uomformholder').load('<?=site_url()."/uomview/index/";?>' + id, function()
		{$('#uomclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#uomformholder' + '\').html(\'\');' + '$(\'' + '#uomclosebutton' + '\').html(\'\');' + '$(\'' + '#uomlist' + '\').load(\'<?=site_url();?>/uomlist\');' + ';"></input>');
		});	
	}
	
	function uomgotopage()
	{
		var page = document.uomlistform.pageno.options[document.uomlistform.pageno.selectedIndex].value;
		
		$("#uomcurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#uomlist',
					success: 		uomshowResponse,
		}; 
		$('#uomlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="uom-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="uomclosebutton"></div>
		<div id="uomformholder"></div>
		<div id="uomlist">
		<!--<form method="post" action="<?=site_url();?>/uomlist/index/" id="uomlistform" name="uomlistform">-->
		<form method="post" action="<?=current_url();?>" id="uomlistform" name="uomlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="uomcurrsort">
			</div>
			<div id="uomsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="uomadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/uomadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/uomadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="uomsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="uomsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="uomsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="uomsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/uomview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('uomview/index/'.$row['id'], $row['uom__name']);?></td><td align='right'><?=number_format($row['uom__multiplier'], 2);?></td><td><?=$row['uom__lastupdate'];?></td><td><?=$row['uom__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="uomview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/uomview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="uomedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/uomedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="uomconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="uomgotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>