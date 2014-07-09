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
					target:        '#roll_rcnlist',
					success: 		roll_rcnshowResponse,
		}; 
		
		$('#roll_rcnlistform').submit(function() { 
			$('#roll_rcnlistform').ajaxSubmit(options);
			return false; 
		});
	});
	
	function roll_rcnconfirmdelete(delid, obj)
	{
		$('#roll_rcn-dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure?</p>', roll_rcnconfirmdelete2(delid, obj));
	}
	
	function roll_rcnconfirmdelete2(delid, obj)
	{
		$( "#roll_rcn-dialog-confirm" ).dialog({
			resizable: false,			
			modal: true,
			buttons: {
				"Delete": function() {
					$( this ).dialog( "close" );
					$(obj).parents('tr').remove();
					roll_rcncalldeletefn('roll_rcndelete', delid, 'roll_rcnlist');
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		$('#roll_rcn-dialog-confirm').html('');
	}
	
	function roll_rcnsortupdown(field, direction)
	{
		$("#roll_rcncurrsort").html('<input type="hidden" name="sortby[]" value="'+field+'"><input type="hidden" name="sortdirection[]" value="'+direction+'">');
		var options = { 
					target:        '#roll_rcnlist',
					success: 		roll_rcnshowResponse,
		}; 
		$('#roll_rcnlistform').ajaxSubmit(options);
		return false;
	}
	
	function roll_rcnshowResponse(responseText, statusText, xhr, $form)  { 
		var options = { 
					target:        '#roll_rcnlist',
					success: 		roll_rcnshowResponse,
		}; 
		
		$('#roll_rcnlistform').submit(function() { 
			$('#roll_rcnlistform').ajaxSubmit(options);
			return false; 
		});
	}
	
	function roll_rcncalldeletefn(con, id, list)
	{
		//$.get("<?=site_url();?>/" + con + "/index/" + id, function(){$('#' + list).load('<?=site_url();?>/' + list);});
		$.get("<?=site_url();?>/" + con + "/index/" + id, function(){});
	}
	
	function roll_rcnadd()
	{
		$('#roll_rcnformholder').load('<?=site_url()."/roll_rcnadd/";?>', function()
		{$('#roll_rcnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roll_rcnformholder' + '\').html(\'\');' + '$(\'' + '#roll_rcnclosebutton' + '\').html(\'\');' + '$(\'' + '#roll_rcnlist' + '\').load(\'<?=site_url();?>/roll_rcnlist\');' + ';"></input>');
		});	
	}
	
	function roll_rcnedit(id)
	{
		$('#roll_rcnformholder').load('<?=site_url()."/roll_rcnedit/index/";?>' + id, function()
		{$('#roll_rcnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roll_rcnformholder' + '\').html(\'\');' + '$(\'' + '#roll_rcnclosebutton' + '\').html(\'\');' + '$(\'' + '#roll_rcnlist' + '\').load(\'<?=site_url();?>/roll_rcnlist\');' + ';"></input>');
		});	
	}
	
	function roll_rcnview(id)
	{
		$('#roll_rcnformholder').load('<?=site_url()."/roll_rcnview/index/";?>' + id, function()
		{$('#roll_rcnclosebutton').html('<input type="button" value="Close" onclick="$(\'' + '#roll_rcnformholder' + '\').html(\'\');' + '$(\'' + '#roll_rcnclosebutton' + '\').html(\'\');' + '$(\'' + '#roll_rcnlist' + '\').load(\'<?=site_url();?>/roll_rcnlist\');' + ';"></input>');
		});	
	}
	
	function roll_rcngotopage()
	{
		var page = document.roll_rcnlistform.pageno.options[document.roll_rcnlistform.pageno.selectedIndex].value;
		
		$("#roll_rcncurrsort").html('<input type="hidden" name="pageno" value="'+page+'">');
		var options = { 
					target:        '#roll_rcnlist',
					success: 		roll_rcnshowResponse,
		}; 
		$('#roll_rcnlistform').ajaxSubmit(options);
	}
	
</script>

		
		<div id="roll_rcn-dialog-confirm" title="Delete this item?">
			
		</div>
		<div id="roll_rcnclosebutton"></div>
		<div id="roll_rcnformholder"></div>
		<div id="roll_rcnlist">
		<!--<form method="post" action="<?=site_url();?>/roll_rcnlist/index/" id="roll_rcnlistform" name="roll_rcnlistform">-->
		<form method="post" action="<?=current_url();?>" id="roll_rcnlistform" name="roll_rcnlistform" class="listform">
		
			
			
			<?php if (true): ?>
				<div id="search">
					<input name="searchtext" value="" ></input>
					<input name="search" type="submit" value="Search" ></input>
				</div>
			<?php endif; ?>
			<div id="roll_rcncurrsort">
			</div>
			<div id="roll_rcnsort">
				<?php foreach ($sortby as $k=>$sb): ?>
					<input type="hidden" name="sortby[]" value="<?=$sb;?>">
					<input type="hidden" name="sortdirection[]" value="<?=$sortdirection[$k];?>">
				<?php endforeach; ?>
			</div>
			
			<?php if (true): ?>
				<!--<input type="button" value="New" onclick="roll_rcnadd()">-->
				<?php if (isset($foreign_id)): ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/roll_rcnadd/index/".$foreign_id;?>')">
				<?php else: ?>
					<input type="button" value="New" onclick="openlink2('<?=site_url()."/roll_rcnadd/index/";?>')">
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
									echo '<a href="#" class="updown" onclick="roll_rcnsortupdown(\''.$k.'\', \'desc\');"><img src="'.base_url().'/css/images/desc.png"/></a>';
								}
								else
								{
									echo '<a href="#" class="updown" onclick="roll_rcnsortupdown(\''.$k.'\', \'asc\');"><img src="'.base_url().'/css/images/asc.png"/></a>';
								}
							}
						}
						else
						{ ?>
							<?php if (true): ?>
								<a href="#" class="updown" onclick="roll_rcnsortupdown('<?=$k;?>', 'asc');"><img src="<?=base_url();?>/css/images/desc.png"/></a>
								<a href="#" class="updown" onclick="roll_rcnsortupdown('<?=$k;?>', 'desc');"><img src="<?=base_url();?>/css/images/asc.png"/></a>
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
					
					<td><a href="<?=base_url().'index.php/roll_rcnview/index/'.$row['id'];?>"><img src="<?=base_url();?>resources/detail.png"></img></a></td>
					<td class='hidden'><?=$row['id'];?></td><td><?=anchor('roll_rcnview/index/'.$row['id'], $row['item__name']);?></td><td><?=$row['item__rollno'];?></td><td><?=$row['item__inktype'];?></td><td><?=$row['item__machinetype'];?></td><td><?=$row['item__core'];?></td><td align='right'><?=number_format($row['item__rd'], 2);?></td><td align='right'><?=number_format($row['item__cd'], 2);?></td><td align='right'><?=number_format($row['item__rl'], 2);?></td><td align='right'><?=number_format($row['item__wl'], 2);?></td><td align='right'><?=number_format($row['item__tl'], 2);?></td><td><?=$row['item__compound'];?></td><td><?=$row['item__processscheme'];?></td><td><?=$row['item__rollertype'];?></td><td align='right'><?=number_format($row['item__minquantity'], 2);?></td><td align='right'><?=number_format($row['item__maxquantity'], 2);?></td><td align='right'><?=number_format($row['item__buffer3months'], 2);?></td><td><?php if (isset($row['item__itemcategory_id']) && $row['itemcategory__name'] != "") echo anchor('item_categoryview/index/'.$row['item__itemcategory_id'], $row['itemcategory__name']);?></td><td><?=$row['item__lastupdate'];?></td><td><?=$row['item__updatedby'];?></td>
					
					<?php if (false): ?>
						<!--<td class="view"><input class="button" type="button" value="View" onclick="roll_rcnview(<?=$row['id'];?>)"></td>-->
						<td class="view"><input class="button" type="button" value="View" onclick="location.href='<?=site_url()."/roll_rcnview/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<!--<td class="edit"><input class="button" type="button" value="Edit" onclick="roll_rcnedit(<?=$row['id'];?>)"></td>-->
						<td class="edit"><input class="button" type="button" value="Edit" onclick="location.href='<?=site_url()."/roll_rcnedit/index/".$row['id'];?>'"></td>
					<?php endif; ?>
					<?php if (false): ?>
						<td class="delete"><input class="button" type="button" value="Delete" onclick="roll_rcnconfirmdelete(<?=$row['id'];?>, this);"></td>
					<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				
			</table>
			
			<b>
			<?php if (true && $totalrecords > $perpage): ?>
				<p>
				Showing <?=$totalrecords<$perpage?$totalrecords:$perpage;?> Out Of <?=$totalrecords;?> Records. 
				
				&nbsp;Page No <?=form_dropdown("pageno", range(1, ceil($totalpages)), $pageno, 'OnChange="roll_rcngotopage();"');?>
				</>
			<?php endif; ?>
			</b>
			
			<br>
			
		</form>
		</div>